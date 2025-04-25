<?php

namespace Bits\DevVitaBundle\Module;

use Contao\CoreBundle\Module\AbstractFrontendModule;
use DevVita\Service\ComposerInfoFetcher;
use Contao\Database;
use Contao\System;
use Contao\Throwable;
use Symfony\Component\HttpFoundation\Response;

class ModuleProjectlist extends AbstractFrontendModule
{
    protected function getResponse(array $templateData, array $module): Response
    {
        $fetcher = System::getContainer()->get(ComposerInfoFetcher::class);
        $entries = Database::getInstance()
            ->prepare("SELECT * FROM tl_dev_vita ORDER BY sorting")
            ->execute();

        $repos = [];

        while ($entries->next()) {
            $row = $entries->row();
            $token = $row['repo_type'] === 'private' ? $row['token'] : $_ENV['GITHUB_PAT'];

            try {
                $data = $fetcher->fetchComposerJson($row['contributor'], $row['repository'], $row['branch']);
                $repos[] = [
                    'name' => $data['name'] ?? '',
                    'description' => $data['description'] ?? '',
                    'require' => $data['require'] ?? [],
                    'repo' => $row['repository'],
                ];
            } catch (Throwable $e) {
                $repos[] = ['error' => $e->getMessage(), 'repo' => $row['repository']];
            }
        }

        return $this->render('@Contao/project_list.html.twig', [
            'repos' => $repos,
        ]);
    }
}

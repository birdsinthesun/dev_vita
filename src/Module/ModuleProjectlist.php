<?php

namespace Bits\DevVitaBundle\Module;


use Bits\DevVitaBundle\Service\ComposerInfoFetcher;
use Contao\Database;
use Contao\System;
use Contao\Throwable;
use Contao\Module;
use Contao\BackendTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Response;

class ModuleProjectlist extends Module
{
    
    public function generate()
	{
		$request = System::getContainer()->get('request_stack')->getCurrentRequest();

		if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ' . $GLOBALS['TL_LANG']['FMD']['projectlist'][0] . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = StringUtil::specialcharsUrl(System::getContainer()->get('router')->generate('contao_backend', array('do'=>'themes', 'table'=>'tl_module', 'act'=>'edit', 'id'=>$this->id)));

			return $objTemplate->parse();
		}

		return $this->getResponse();
	}
    
    
    protected function compile()
	{
    
        
    
    
    
    
    
    }
    
    
    
    protected function getResponse()
    {
        $fetcher = System::getContainer()->get(ComposerInfoFetcher::class);
        $entries = Database::getInstance()
            ->prepare("SELECT * FROM tl_dev_vita ORDER BY sorting")
            ->execute();

        $repos = [];

        while ($entries->next()) {
            $row = $entries->row();
            $token = $row['repo_type'] === 'private' ? $row['token'] :'';

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
        $twig = System::getContainer()->get('twig');
        return $twig->render('@Contao/project_list.html.twig', [
            'repos' => $repos,
        ]);
    }
}

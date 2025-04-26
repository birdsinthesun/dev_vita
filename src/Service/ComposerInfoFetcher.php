<?php

namespace Bits\DevVitaBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class ComposerInfoFetcher implements ServiceSubscriberInterface
{
    private HttpClientInterface $client;
    private string $githubToken;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->githubToken = 'ToDo';
    }

    public function fetchComposerJson(string $owner, string $repo, string $branch = 'main'): array
    {
        $response = $this->client->request('GET', "https://api.github.com/repos/$owner/$repo/contents/composer.json", [
       
            'query' => ['ref' => $branch],
        ]);

        $data = $response->toArray();
        return json_decode(base64_decode($data['content']), true);
    }
    public static function getSubscribedServices(): array
    {
        return [
            HttpClientInterface::class,
        ];
    }
}

<?php

namespace Bits\DevVitaBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class ComposerInfoFetcher implements ServiceSubscriberInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchComposerJson(string $owner, string $repo, string $branch = 'main',$token): array
    {
        $response = $this->client->request('GET', "https://api.github.com/repos/$owner/$repo/contents/composer.json", [
            'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/vnd.github.v3+json',
                ],
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

<?php

namespace Bits\DevVitaBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ComposerInfoFetcher
{
    private HttpClientInterface $client;
    private string $githubToken;

    public function __construct(HttpClientInterface $client, string $githubToken)
    {
        $this->client = $client;
        $this->githubToken = $githubToken;
    }

    public function fetchComposerJson(string $owner, string $repo, string $branch = 'main'): array
    {
        $response = $this->client->request('GET', "https://api.github.com/repos/$owner/$repo/contents/composer.json", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->githubToken,
                'Accept' => 'application/vnd.github.v3+json',
            ],
            'query' => ['ref' => $branch],
        ]);

        $data = $response->toArray();
        return json_decode(base64_decode($data['content']), true);
    }
}

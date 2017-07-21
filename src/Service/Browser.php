<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Service;

use GuzzleHttp\Client;

class Browser
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $app_client;

    /**
     * @param Client $client
     * @param string $host
     * @param string $app_client
     */
    public function __construct(Client $client, $host, $app_client)
    {
        $this->client = $client;
        $this->host = $host;
        $this->app_client = $app_client;
    }

    /**
     * @param string $path
     * @param array  $options
     *
     * @return string
     */
    public function get($path, array $options = [])
    {
        if ($this->app_client) {
            $options['headers'] = array_merge(
                ['User-Agent' => $this->app_client],
                isset($options['headers']) ? $options['headers'] : []
            );
        }

        $response = $this->client->request('GET', $this->host.$path, $options);

        $content = $response->getBody()->getContents();

        return $content;
    }
}

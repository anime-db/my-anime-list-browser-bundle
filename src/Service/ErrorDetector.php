<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Service;

use AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\BannedException;
use AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\ErrorException;
use AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\NotFoundException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class ErrorDetector
{
    /**
     * @param \Exception $exception
     *
     * @return ErrorException|NotFoundException
     */
    public function wrap(\Exception $exception)
    {
        if ($exception instanceof ClientException &&
            $exception->getResponse() instanceof ResponseInterface &&
            $exception->getResponse()->getStatusCode() == 404
        ) {
            return NotFoundException::page();
        }

        return ErrorException::wrap($exception);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return string
     */
    public function detect(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 404) {
            throw NotFoundException::page();
        }

        $content = $response->getBody()->getContents();

        if (strpos($content, 'Access has been restricted for this account.') !== false) {
            throw BannedException::banned();
        }

        return $content;
    }
}

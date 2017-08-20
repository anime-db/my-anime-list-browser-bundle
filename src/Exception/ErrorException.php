<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception;

class ErrorException extends \RuntimeException
{
    /**
     * @param \Exception $e
     *
     * @return ErrorException
     */
    public static function wrap(\Exception $e)
    {
        return new self($e->getMessage(), $e->getCode(), $e);
    }
}

<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception;

class NotFoundException extends ErrorException
{
    /**
     * @return NotFoundException
     */
    public static function page()
    {
        return new self('Page not found.');
    }
}

<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception;

class BannedException extends ErrorException
{
    /**
     * @return BannedException
     */
    public static function banned()
    {
        return new self('Access has been restricted for this account.');
    }
}

[![MyAnimeList.com](https://myanimelist.cdn-dena.com/images/mal-logo-xsmall.png)](https://myanimelist.com)

[![Latest Stable Version](https://img.shields.io/packagist/v/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600&label=stable)](https://packagist.org/packages/anime-db/my-anime-list-browser-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600)](https://packagist.org/packages/anime-db/my-anime-list-browser-bundle)
[![Build Status](https://img.shields.io/travis/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600)](https://travis-ci.org/anime-db/my-anime-list-browser-bundle)
[![Coverage Status](https://img.shields.io/coveralls/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600)](https://coveralls.io/github/anime-db/my-anime-list-browser-bundle?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600)](https://scrutinizer-ci.com/g/anime-db/my-anime-list-browser-bundle/?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/199d5653-9372-48d2-8da7-d62aaa1d2ea8.svg?maxAge=3600&label=SLInsight)](https://insight.sensiolabs.com/projects/199d5653-9372-48d2-8da7-d62aaa1d2ea8)
[![StyleCI](https://styleci.io/repos/97733243/shield?branch=master)](https://styleci.io/repos/97733243)
[![License](https://img.shields.io/packagist/l/anime-db/my-anime-list-browser-bundle.svg?maxAge=3600)](https://github.com/anime-db/my-anime-list-browser-bundle)

MyAnimeList.net API browser
===========================

Installation
------------

Pretty simple with [Composer](http://packagist.org), run:

```sh
composer require anime-db/my-anime-list-browser-bundle
```

Add AnimeDbWorldArtBrowserBundle to your application kernel

```php
// app/appKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new AnimeDb\Bundle\MyAnimeListBrowserBundle\AnimeDbMyAnimeListBrowserBundle(),
    );
}
```

Configuration
-------------

```yml
anime_db_my_anime_list_browser:
    # Host name
    # As a default used 'http://myanimelist.net'
    host: 'http://myanimelist.net'

    # HTTP User-Agent
    # No default value
    client: 'My Custom Bot 1.0'
```

Usage
-----

Get info for anime [Cowboy Bebop](https://myanimelist.net/anime/1/Cowboy_Bebop):

```php
$content = $this->get('anime_db.my_anime_list.browser')->get('/anime/1');
```

License
-------

This bundle is under the [GPL v3 license](http://opensource.org/licenses/GPL-3.0).
See the complete license in the file: LICENSE

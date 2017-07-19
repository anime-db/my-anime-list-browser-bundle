<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Config tree builder.
     *
     * Example config:
     *
     * anime_db_my_anime_list_browser:
     *     host: 'http://myanimelist.net'
     *     client: 'My Custom Bot 1.0'
     *
     * @return ArrayNodeDefinition
     */
    public function getConfigTreeBuilder()
    {
        return (new TreeBuilder())
            ->root('anime_db_my_anime_list_browser')
                ->children()
                    ->scalarNode('host')
                        ->defaultValue('http://myanimelist.net')
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('client')
                        ->defaultValue('')
                    ->end()
                ->end()
            ->end()
        ;
    }
}

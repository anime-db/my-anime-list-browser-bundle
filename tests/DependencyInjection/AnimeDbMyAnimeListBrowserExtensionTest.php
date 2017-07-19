<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Tests\DependencyInjection;

use AnimeDb\Bundle\MyAnimeListBrowserBundle\DependencyInjection\AnimeDbMyAnimeListBrowserExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class AnimeDbMyAnimeListBrowserExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ContainerBuilder
     */
    private $container;

    /**
     * @var AnimeDbMyAnimeListBrowserExtension
     */
    private $extension;

    protected function setUp()
    {
        $this->container = $this->getMock(ContainerBuilder::class);
        $this->extension = new AnimeDbMyAnimeListBrowserExtension();
    }

    /**
     * @return array
     */
    public function config()
    {
        return [
            [
                [],
                'http://myanimelist.net',
                '',
            ],
            [
                [
                    'anime_db_my_anime_list_browser' => [
                        'host' => 'https://myanimelist.net',
                        'client' => 'My Custom Bot 1.0',
                    ],
                ],
                'https://myanimelist.net',
                'My Custom Bot 1.0',
            ],
        ];
    }

    /**
     * @dataProvider config
     *
     * @param array  $config
     * @param string $host
     * @param string $client
     */
    public function testLoad(array $config, $host, $client)
    {
        $browser = $this->getMock(Definition::class);
        $browser
            ->expects($this->at(0))
            ->method('replaceArgument')
            ->with(1, $host)
            ->will($this->returnSelf())
        ;
        $browser
            ->expects($this->at(1))
            ->method('replaceArgument')
            ->with(2, $client)
            ->will($this->returnSelf())
        ;

        $this->container
            ->expects($this->once())
            ->method('getDefinition')
            ->with('anime_db.my_anime_list.browser')
            ->will($this->returnValue($browser))
        ;

        $this->extension->load($config, $this->container);
    }
}

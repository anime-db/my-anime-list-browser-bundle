<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Tests\DependencyInjection;

use AnimeDb\Bundle\MyAnimeListBrowserBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\ArrayNode;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ScalarNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testConfigTree()
    {
        $tree_builder = $this->configuration->getConfigTreeBuilder();

        $this->assertInstanceOf(TreeBuilder::class, $tree_builder);

        /* @var $tree ArrayNode */
        $tree = $tree_builder->buildTree();

        $this->assertInstanceOf(ArrayNode::class, $tree);
        $this->assertEquals('anime_db_my_anime_list_browser', $tree->getName());

        /* @var $children ScalarNode[] */
        $children = $tree->getChildren();

        $this->assertInternalType('array', $children);
        $this->assertEquals(['host', 'client'], array_keys($children));

        $this->assertInstanceOf(ScalarNode::class, $children['host']);
        $this->assertEquals('http://myanimelist.net', $children['host']->getDefaultValue());
        $this->assertFalse($children['host']->isRequired());

        $this->assertInstanceOf(ScalarNode::class, $children['client']);
        $this->assertEquals('', $children['client']->getDefaultValue());
        $this->assertFalse($children['client']->isRequired());
    }
}

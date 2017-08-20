<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Tests\Service;

use AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\ErrorException;
use AnimeDb\Bundle\MyAnimeListBrowserBundle\Service\Browser;
use AnimeDb\Bundle\MyAnimeListBrowserBundle\Service\ErrorDetector;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class BrowserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $host = 'example.org';

    /**
     * @var string
     */
    private $app_client = 'My Custom Bot 1.0';

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|HttpClient
     */
    private $client;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    private $response;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ErrorDetector
     */
    private $detector;

    /**
     * @var Browser
     */
    private $browser;

    protected function setUp()
    {
        $this->client = $this->getMock(HttpClient::class);
        $this->response = $this->getMock(ResponseInterface::class);
        $this->detector = $this->getMock(ErrorDetector::class);

        $this->browser = new Browser($this->client, $this->detector, $this->host, $this->app_client);
    }

    /**
     * @return array
     */
    public function appClients()
    {
        return [
            [''],
            ['Override User Agent'],
        ];
    }

    /**
     * @dataProvider appClients
     *
     * @param string $app_client
     */
    public function testGet($app_client)
    {
        $path = '/foo';
        $params = ['bar' => 'baz'];
        $options = $params + [
            'headers' => [
                'User-Agent' => $this->app_client,
            ],
        ];

        if ($app_client) {
            $options['headers']['User-Agent'] = $app_client;
            $params['headers']['User-Agent'] = $app_client;
        }

        $content = 'Hello, world!';

        $this->detector
            ->expects($this->once())
            ->method('detect')
            ->with($this->response)
            ->will($this->returnValue($content))
        ;

        $this->client
            ->expects($this->once())
            ->method('request')
            ->with('GET', $this->host.$path, $options)
            ->will($this->returnValue($this->response))
        ;

        $this->assertEquals($content, $this->browser->get($path, $params));
    }

    /**
     * @expectedException \AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\ErrorException
     */
    public function testException()
    {
        $exception = new \Exception();
        $wrap = ErrorException::wrap($exception);

        $this->detector
            ->expects($this->once())
            ->method('wrap')
            ->with($exception)
            ->will($this->returnValue($wrap))
        ;

        $this->client
            ->expects($this->once())
            ->method('request')
            ->will($this->throwException($exception))
        ;

        $this->browser->get('');
    }
}

<?php

/**
 * AnimeDb package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 * @license   http://opensource.org/licenses/GPL-3.0 GPL v3
 */

namespace AnimeDb\Bundle\MyAnimeListBrowserBundle\Tests\Service;

use AnimeDb\Bundle\MyAnimeListBrowserBundle\Service\ErrorDetector;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ErrorDetectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|StreamInterface
     */
    private $stream;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ResponseInterface
     */
    private $response;

    /**
     * @var ErrorDetector
     */
    private $detector;

    protected function setUp()
    {
        $this->stream = $this->getMock(StreamInterface::class);
        $this->response = $this->getMock(ResponseInterface::class);
        $this->detector = new ErrorDetector();
    }

    /**
     * @expectedException \AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\NotFoundException
     */
    public function testNotFound()
    {
        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(404))
        ;

        $this->detector->detect($this->response);
    }

    /**
     * @expectedException \AnimeDb\Bundle\MyAnimeListBrowserBundle\Exception\BannedException
     */
    public function testBanned()
    {
        $content = '<foo>Access has been restricted for this account.</foo>';

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(200))
        ;
        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($this->stream))
        ;

        $this->stream
            ->expects($this->once())
            ->method('getContents')
            ->will($this->returnValue($content))
        ;

        $this->detector->detect($this->response);
    }

    public function testNoErrors()
    {
        $content = '<foo>No errors.</foo>';

        $this->response
            ->expects($this->once())
            ->method('getStatusCode')
            ->will($this->returnValue(200))
        ;
        $this->response
            ->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($this->stream))
        ;

        $this->stream
            ->expects($this->once())
            ->method('getContents')
            ->will($this->returnValue($content))
        ;

        $this->assertEquals($content, $this->detector->detect($this->response));
    }
}

<?php
require_once('Request.php');
require_once('Response.php');
require_once('Cookie.php');
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $response = new Response();
        $response->status('300');
        $this->assertEquals('300', $response->status, '->get status Code');

        $response = new Response();
        $response->headers('cache-control', 'private');
        $response->headers('Last-Modified', 'Sun, 25 Aug 2013 18:33:31 GMT');
        $response->headers('date', 'Sun, 25 Aug 2013 18:33:31 GMT');

        $this->assertEquals('private', $response->getByName('cache-control', $response->header), '->get header by name');

        $this->assertEquals(array(
            'cache-control'=>array('private'),
            'Last-modified'=>array('Sun, 25 Aug 2013 18:33:31 GMT'),
            'date'=>array('Sun, 25 Aug 2013 18:33:31 GMT')), $response->header, '->get header all');



        $response = new Response();
        $response->body('New content');
        $this->assertEquals((string) 'New content', $response->body(), '->get content');

        $response = new Response();
        $response->cookie('name', 'foo2');

        $this->assertEquals('foo2',$response->cookies->get('name'), '->get cookie by name');

        $this->assertEquals(array('name' => 'foo2'), $response->cookies->all(), '->get set cookies array');

    }
}
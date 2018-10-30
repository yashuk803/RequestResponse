<?php
require_once('Request.php');
require_once('Response.php');
require_once('Cookie.php');
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
class RequestTest extends TestCase
{

    public function testRequest()
    {

        $request = new Request();
        $this->assertEquals('GET', $request->method, '->get method GET');

        $request = new Request();
        $request->method('POST');
        $this->assertEquals('POST', $request->method, '->get method POST');


        $request = new Request();
        $request->headers('X-HTTP-METHOD-OVERRIDE', 'delete');
        $request->headers('CONTENT_MD5', 'md5');
        $this->assertEquals(array('X-HTTP-METHOD-OVERRIDE'=>array('delete'), 'CONTENT_MD5' => array('md5')), $request->header, '->get all set headers ');
        $this->assertEquals('md5', $request->getByName('CONTENT_MD5', $request->header), '->get all set headers ');




        $cookies = [
            'name'=>'newvalue',
            'expires'=>'date',
            'path'=>'/',
            'domain'=>'example.org'
        ];

        $request = new Request();
        $request->cookies = $cookies;
        $this->assertEquals([
            'name'=>'newvalue',
            'expires'=>'date',
            'path'=>'/',
            'domain'=>'example.org'
        ], $request->cookies, '->Returns all cookies');
        $this->assertEquals('newvalue', $request->getByName('name', $request->cookies),'->Returns a cookies value by name ');


        $request = new Request();
        $request->cookie('name', 'newvalue');
        $request->cookie('domain', 'example.org');
        $this->assertEquals('newvalue', $request->getByName('name', $request->cookies),'->Returns a cookies value by name ');
        $this->assertEquals([
            'name'=>'newvalue',
            'domain'=>'example.org'
        ], $request->cookies,'->Returns all cookies');


    }


    public function testCreateFromGlobals()
    {

        $_GET['foo1'] = 'bar1';
        $_POST['foo2'] = 'bar2';
        $_COOKIE['foo3'] = 'bar3';

        $request = new Request();
        $request->query($_GET);
        $request->post($_POST);
        $request->cookie($_COOKIE);

        $this->assertEquals('bar1', $request->getByName('foo1', $request->get), '::fromGlobals() uses values from $_GET');
        $this->assertEquals('bar3', $request->getByName('foo3', $request->cookies), '::fromGlobals() uses values from $_POST');
        $this->assertEquals('bar2', $request->getByName('foo2', $request->post), '::fromGlobals() uses values from $_COOKIE');
    }

}
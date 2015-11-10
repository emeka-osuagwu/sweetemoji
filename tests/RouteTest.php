<?php

namespace Test;

use PDO;
use Mockery;
use Slim\Environment;
use PHPUnit_Framework_TestCase;

class RoutesTest extends PHPUnit_Framework_TestCase
{
    
    public function request($method, $path, $options = array())
    {
        // Capture STDOUT
        ob_start();

        // Prepare a mock environment
        Environment::mock(array_merge(array(
            'PATH_INFO'         => $path,
            'SERVER_NAME'       => 'slim-test.dev',
            'REQUEST_METHOD'    => $method,
        ), $options));

        $app = new \Slim\Slim();
        $this->app      = $app;
        $this->request  = $app->request();
        $this->response = $app->response();

        return ob_get_clean();
    }

    public function get( $path, $options = array() )
    {
        $this->request('GET', $path, $options);
    }

    public function testIndex()
    {
        $this->get('/emojis');
        $this->assertEquals('200', $this->response->status());
    }

}
<?php

namespace Test;

use Mockery;

use PHPUnit_Framework_TestCase;

class FetchData extends PHPUnit_Framework_TestCase
{

   public function tearDown()
   {
       Mockery::close();
   } 

	public function testCheckForTable()
	{
	    $dbConnMocked = Mockery::mock('use Emeka\Candy\Database\Connections\Connect');
	    //$statement = Mockery::mock('\PDOStatement');

	    // $dbConnMocked->shouldReceive('query')->with('SELECT 1 FROM dogs LIMIT 1')->andReturn($statement);
	    // $dbConnMocked->shouldReceive('query')->with('SELECT 1 FROM users LIMIT 1')->andReturn(false);

	    // $this->assertTrue(Backbone::checkForTable('dogs', $dbConnMocked));
	    // $this->assertFalse(Backbone::checkForTable('users', $dbConnMocked));
	}
}
<?php

namespace Test;

use PHPUnit_Framework_TestCase;
use Mockery;

class FetchData extends PHPUnit_Framework_TestCase
{

	public function testCheckForTables()
	{
	    $dbConnMocked 	= Mockery::mock('Emeka\Candy\Database\Connections\Connect');
	    $statement 		= Mockery::mock('\PDOStatement');

	    $dbConnMocked->shouldReceive('query')->with('SELECT * FROM users LIMIT 1')->andReturn($statement);
	    $dbConnMocked->shouldReceive('query')->with('SELECT * FROM users LIMIT 1')->andReturn(false);
	    
	    $this->assertTrue(Backbone::checkForTable('users', $dbConnMocked));
	    $this->assertFalse(Backbone::checkForTable('users', $dbConnMocked));
	}

	
}
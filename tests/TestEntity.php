<?php

namespace Test;

use PDO;
use Mockery;

class TestEntity extends PHPUnit_Framework_TestCase
{
	
	public function testGetEntity()
	{	    
	    $this->assertJson(GetEntity::all('users', $dbConnMocked));	      
	}
}
<?php

namespace Test;

use PDO;
use Mockery;
use PHPUnit_Framework_TestCase;
use Emeka\Candy\Model\GetEntity;
use Emeka\Candy\Model\FindEntity;
use Emeka\Candy\Model\SaveEntity;
use Emeka\Candy\Model\WhereEntity;
use Emeka\Candy\Model\DeleteEntity;

class TestEntity extends PHPUnit_Framework_TestCase
{
	
	public function testGetEntity()
	{	    
	    

	    $this->assertJson(GetEntity::all('users', $dbConnMocked));	      
	}
}
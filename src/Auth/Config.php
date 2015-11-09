<?php

namespace Emeka\SweetEmoji\Auth;


use Dotenv\Dotenv;

class Config
{
	
	public function __construct()
	{
		$dotenv = new Dotenv($_SERVER['DOCUMENT_ROOT']);
		
		if ( ! getenv('APP_ENV') )
		{
			$dotenv->load();
		}

		$this->jwt_key  	= getenv('key');
		$this->jwt_nbf      = getenv('nbf');
		$this->jwt_iat      = getenv('iat');
		$this->jwt_exp      = getenv('exp');
		$this->jwt_iss     	= getenv('iss');
	}

	public function jwt_iss ()
	{
		return $this->jwt_iss;
	}

	public function jwt_nbf ()
	{
		return $this->jwt_nbf;
	}

	public function jwt_iat ()
	{
		return $this->jwt_iat;
	}

	public function jwt_exp ()
	{
		return $this->jwt_exp;
	}

	public function jwt_key ()
	{
		return $this->jwt_key;
	}


}
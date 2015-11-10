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

		$this->jwt_key  				= getenv('key');
		$this->jwt_issuer     			= getenv('iss');
		$this->jwt_issuer_at      		= getenv('iat');
		$this->jwt_not_before      		= getenv('nbf');
		$this->jwt_expiration_time      = getenv('exp');
	}
	
	/*
	| Return json web token key property 
	*/
	public function jwt_key ()
	{
		return $this->jwt_key;
	}
	

	/*
	| Return json web token Issuer Claim property 
	*/
	public function jwt_issuer ()
	{
		return $this->jwt_issuer;
	}


	/*
	| Return json web token Issuer At property
	*/
	public function jwt_issuer_at ()
	{
		return $this->jwt_issuer_at;
	}

	/*
	| Return json web token Not Before property
	*/
	public function jwt_not_before ()
	{
		return $this->jwt_not_before;
	}

	/*
	| Return json web token Expiration Time property
	*/
	public function jwt_expiration_time ()
	{
		return $this->jwt_expiration_time;
	}


}
<?php

namespace Emeka\SweetEmoji\Model;

use Emeka\Candy\Model\BaseModel;

class User extends BaseModel
{
	private static $user;
	protected static $primaryKey = 'id';

	public static function findByToken($token)
	{
		self::$user = User::where('token', $token);
	}

}


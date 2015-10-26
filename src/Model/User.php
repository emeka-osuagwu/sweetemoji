<?php

namespace Emeka\SweetEmoji\Model;

use Emeka\Candy\Model\BaseModel;

class User extends BaseModel
{
	protected static $primaryKey = 'id';

	public static function findByToken($token)
	{
		return User::where('token',$token);
	}
}
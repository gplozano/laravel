<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VccUser extends Model
{
    // users are currently stored in a view-based DomainDetails table
    protected $table = 'DomainDetails';
    // there are no timestamps on users
    public $timestamps = false;
    // primary key is different from id
    protected $primaryKey = "user_id";

    public static function checkCredentials($login, $password) {
        $passwordHash = base64_encode(sha1($password, true));
	    $result = VccUser::where('user_name', $login)->where('password', $passwordHash)->first();

        if ($result == null)
        {
            return null;
        } 
    	
    	return $result->password == $passwordHash ? $result : null;
    }
}

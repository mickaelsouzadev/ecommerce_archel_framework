<?php
/* PHP Class for hash and verify passwords
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-11-12
 */
namespace App;

class Password
{
    public static function hashPassword($password, $algorithm = PASSWORD_DEFAULT, $cost = 10) 
    {
        return password_hash($password, $algorithm, ['cost' => $cost]);
    }
    
    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
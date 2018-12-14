<?php  
/* PHP Class for create and managing sessions
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-12-14
 */
namespace App;

class Session 
{
    public static function start()
    {
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function setSessions(Array $sessions)
    {
        foreach ($sessions as $name => $value) {
            self::setSession($name, $value);
        }
    }

    public static function getSession($name)
    {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : false;
    }

    public static function getSessions(Array $sessions)
    {   
        $list_of_sessions = [];
        foreach ($sessions as $name) {
            $list_of_sessions[$name] = self::getSession($name);
        }

        return $list_of_sessions;
    }

    public static function getAllSessions()
    {   
        $list_of_sessions = [];
        foreach ($_SESSION as $name => $value) {
            $list_of_sessions[$name] = self::getSession($name);
        }
        return $list_of_sessions;
    }

    public static function setSessionAttribute($name, $attr, $value) 
    {
        $_SESSION[$name][$attr] = $value;
    }

    public static function getSessionAttribute($name, $attr) 
    {
        if(!isset($_SESSION[$name][$attr])) {
            self::setSessionAttribute($name, $attr, null);
        }

        return (isset($_SESSION[$name][$attr])) ? $_SESSION[$name][$attr] : false;
    }

    public static function sessionExists($name) 
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public function destroySession($name)
    {
        unset($_SESSION[$name]);
    }

    public static function destroySessions()
    {
        session_destroy();
    }

}
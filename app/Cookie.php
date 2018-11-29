<?php  
/* PHP Class for create and managing cookies
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-11-07
 */
namespace App;

class Cookie 
{
	private $time;

	public function __construct()
	{
		$this->time = time() + 1*86400;
	}

	public static function setCookie($name, $value)
	{
		setcookie($name, $value, (new self)->time,'/');
	}

	public static function setCookies(Array $cookies)
	{
		foreach ($cookies as $name => $value) {
			self::setCookie($name, $value);
		}
	}

	public static function getCookie($name) 
	{
		return filter_input(INPUT_COOKIE, $name); 
	}

	public static function getCookies(Array $cookies)
	{
		$list_of_cookies = [];
		foreach ($cookies as $name) {
			$list_of_cookies[$name] = self::getCookie($name);
		}
		return $list_of_cookies;
	}

	public static function cookieExists($name)
	{
		return (filter_input(INPUT_COOKIE,$name))?true:false; 
	}

	public static function destroyCookie($name) 
	{
		setcookie($name, null, -1,'/');
	}

	public static function destroyCookies(Array $cookies)
	{
		foreach ($cookies as $name) {
			self::destroyCookie($name);
		}
	}

	public static function destroyAllCookies()
	{
		foreach ($_COOKIE as $name => $value) {
			self::destroyCookie($name);
		}
	}

}
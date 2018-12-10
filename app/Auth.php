<?php  
/* PHP Class for managing the authentication of the users
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-12-09
 */
namespace App;
use App\Session;
use App\Cookie;
use App\Password;
// use App\Models\UserModel;

class Auth 
{
	private $user;

	public function __construct()
	{
		Session::start();
	}

	public function login($form_password, $user, $type = 'user')
	{
		$this->user = $user;
		
		try {
			if(Password::verifyPassword($form_password, $this->user['password'])) {
				$this->createSession($type);
				return true;
			} else {
				throw new \Exception('Email ou senha incorretos!');
			}
		} catch(\Exception $e) {
			print $e->getMessage();
		}

	}

	public function newUserLogin($user, $type = 'user')
	{
		$this->user = $user;

		if(Session::sessionExists('user')) {
			Session::destroySessions();
		}

		$this->createSession($type);
	}

	public static function verifyAdminIsLogged()
	{
		if(Session::sessionExists('admin')) {
			return Session::sessionExists('admin');
		} else {
			return Cookie::cookieExists('admin');
		}	 
	}
	public static function verifyUserIsLogged()
	{	
		if(Session::sessionExists('user')) {
			return true;
		} else {
			return Cookie::cookieExists('user');
		}
	}
	public function createSession($type = 'user')
	{
		Session::setSession($type, $this->user);
	}

	public function createCookie($type = 'user')
	{
		Cookie::setCookies([$type => $this->user['username'], 'password' => $this->user['password']]);
	}

	public function logout()
	{
		Session::destroySessions();
		Cookie::destroyAllCookies();
	}
		
}
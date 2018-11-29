<?php  
/* PHP Class for managing the authentication of the users
 * AUTHOR: Mickael Souza
 * LAST EDIT: 2018-11-12
 */
namespace App;
use App\Session;
use App\Cookie;
use App\Password;
// use App\Models\UserModel;

class Auth 
{
	private $model;
	private $user;

	public function __construct($model)
	{
		$this->model = new $model();
		Session::start();
	}

	public function login($email, $password, $type = 'user')
	{
		$this->user = $this->model->getByEmail($email);

		try {
			if(Password::verifyPassword($password, $this->user->getPassword())) {
				$this->createSession($type);
				return true;
			} else {
				throw new Exception('Email ou senha incorretos!');
			}
		} catch(Exception $e) {
			print $e->getMessage();
		}

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
		Cookie::setCookies([$type => $this->user->getUsername(), 'password' => $this->user->getPassword()]);
	}

	public function logout()
	{
		Session::destroySessions();
		Cookie::destroyAllCookies();
	}
		
}
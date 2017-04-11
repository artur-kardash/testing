<?php


class Controller {
	
	public $model;
	public $view;
	private static $user_role;

	/**
	 * @return mixed
	 */
	protected static function getUserRole()
	{
		return self::$user_role;
	}

	/**
	 * @param mixed $user_role
	 */
	protected static function setUserRole($user_role)
	{
		self::$user_role = $user_role;
	}


	
	function __construct()
	{
		$this->view = new View();
	}
	
	function action_index()
	{

	}
	public function db()
	{
			$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if ($con->connect_errno) {
				printf("Connect failed: %s\n", $con->connect_error);
				exit();
			}
			return $con;
	}
}
?>

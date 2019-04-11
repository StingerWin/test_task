<?php
Class Controller_Index Extends Controller_Base 
{
	protected function _initTemplate($title, $description)
	{

		return parent::_initTemplate($title, $description);

	}

	public function index() 
	{


		$template = $this->_initTemplate('My Site', '');

		$template->setFile('templates/main.phtml');

		$db = $this->_registry->get('db');
		$login = $_SESSION['login'];
		$query_login = "SELECT * FROM `registered_users` WHERE login='$login'";
		$result_login = mysqli_query($db, $query_login);
		$row_login = mysqli_fetch_array($result_login);
		$template->set('row_login',$row_login);

		if (isset($_GET['log_out'])) {
			unset($_SESSION['login']);
			header('Location:' .base_url);
		}

		$this->_renderLayout($template, true);
	}
}
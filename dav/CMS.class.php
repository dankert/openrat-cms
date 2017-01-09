<?php 


class CMS extends Client
{
	var $login = false;
	var $token;

	function login($user, $password,$dbid )
	{
		
		$this->action    = 'login';
		$this->subaction = 'login';
		$this->method    = 'GET';
		
		$result = $this->call('GET','login','login' );
		// TODO: Read database Ids from $result
		
		$this->action    = 'login';
		$this->subaction = 'login';
		$this->method    = 'POST';
		
		$result = $this->call('POST','login','login',array('login_name'=>$user,'login_password'=>$password,'dbid'=>$dbid) );
		
		return( $result['success'] == 'true' );
	}
}

?>
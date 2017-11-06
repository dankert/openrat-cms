<?php 

define('CMS_READ'  ,'GET' );
define('CMS_WRITE' ,'POST');

class CMS extends Client
{
	var $login = false;
	var $token;

	function login($user, $password,$dbid )
	{
		
		// Erster Request der Sitzung muss ein GET-Request sein.
		// Hier wird auch der Token gelesen.
		$result = $this->call(CMS_READ,'login','login' );
		
		$result = $this->call(CMS_WRITE,'login','login',array('login_name'=>$user,'login_password'=>$password,'dbid'=>$dbid) );
		
		if	( $result['success'] != 'true' ) {
			throw new Exception( 'Login failed. '.print_r($result['notices'],true));
		}
	}
	
	
	function projectlist()
	{
		$result = $this->call(CMS_READ,'projectlist','edit' );

// 		Logger::debug( print_r($result,true) );
		return( $result['output'] );
	}

	
	function project($projectid)
	{
		$result = $this->call(CMS_READ,'project','edit',array('id'=>$projectid) );
	
		return( $result['output'] );
	}
	
	function folder($id)
	{
		$result = $this->call(CMS_READ,'folder','edit',array('id'=>$id) );
	
		return( $result['output'] );
	}
	
	function page($id)
	{
		$result = $this->call(CMS_READ,'page','edit',array('id'=>$id) );
	
		return( $result['output'] );
	}
	
	function link($id)
	{
		$result = $this->call(CMS_READ,'link','edit',array('id'=>$id) );
	
		return( $result['output'] );
	}
	
	function file($id)
	{
		$result = $this->call(CMS_READ,'file','edit',array('id'=>$id) );
	
		return( $result['output'] );
	}

	function filevalue($id)
	{
		$result = $this->call(CMS_READ,'file','show',array('id'=>$id) );
	
		return( $result['output'] );
	}
	
}

?>
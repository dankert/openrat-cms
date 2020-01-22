<?php

/**
 * Very simple approach to identify a browsers name and platform.
 */
class Browser {

    public $name;
    public $platform;


	/**
	 * Takes the user agent from the HTTP request and analyzes name and platform.
	 */
    public function __construct()
    {
        $agent = @$_SERVER['HTTP_USER_AGENT'];


        if (stripos($agent, 'Opera') || stripos($agent, 'OPR/'))
            $this->name = 'Opera';
        elseif (stripos($agent, 'Edge'))
            $this->name= 'Microsoft Edge';
        elseif (stripos($agent, 'vivaldi'))
            $this->name= 'Vivaldi';
        elseif (stripos($agent, 'netscape'))
            $this->name= 'Netscape';
        elseif (stripos($agent, 'Chrome'))
            $this->name= 'Google Chrome';
        elseif (stripos($agent, 'Safari'))
            $this->name= 'Safari';
        elseif (stripos($agent, 'Firefox'))
            $this->name= 'Mozilla Firefox';
        elseif (stripos($agent, 'MSIE') || stripos($agent, 'Trident/7'))
            $this->name= 'Internet Explorer';
        else
            $this->name= 'Unknown Browser';

        if (stripos($agent, 'Linux') || stripos($agent, 'linux'))
            $this->platform = 'Linux';
        elseif (stripos($agent, 'Windows') || stripos($agent, 'win32'))
            $this->platform = 'Windows';
        elseif (stripos($agent, 'android') )
            $this->platform = 'Android';
        elseif (stripos($agent, 'mac os') || stripos($agent, 'cpu os') || stripos($agent, 'iPhone') || stripos($agent, 'OS X'))
            $this->platform = 'Android';
        elseif (stripos($agent, 'cros') )
            $this->platform = 'Chrome OS';
        elseif (stripos($agent, 'SymbOS') )
            $this->platform = 'Symbian OS';
        elseif (stripos($agent, 'windows phone') )
            $this->platform = 'Microsoft Windows Phone  ';
        elseif (stripos($agent, 'nokia') )
            $this->platform = 'Nokia';
        elseif (stripos($agent, 'blackberry') )
            $this->platform = 'Blackberry';
        elseif (stripos($agent, 'openbsd') )
            $this->platform = 'OpenBSD';
        elseif (stripos($agent, 'freebsd') )
            $this->platform = 'FreeBSD';
        else
            $this->name= 'Unknown OS';

    }
}

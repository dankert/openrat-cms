<?php
namespace cms\model;

// Diese Objekte stehen zeitweise in der Sitzung, daher muessen dieser immer geparst werden.
require_once( __DIR__."ModelBase.class.".PHP_EXT );
require_once( __DIR__."Value.class.".PHP_EXT );
require_once( __DIR__."Acl.class.".PHP_EXT );
require_once( __DIR__."Template.class.".PHP_EXT );
require_once( __DIR__."Object.class.".PHP_EXT );
require_once( __DIR__."Folder.class.".PHP_EXT );
require_once( __DIR__."Link.class.".PHP_EXT );
require_once( __DIR__."Url.class.".PHP_EXT );
require_once( __DIR__."File.class.".PHP_EXT );
require_once( __DIR__."User.class.".PHP_EXT );
require_once( __DIR__."Group.class.".PHP_EXT );
require_once( __DIR__."Project.class.".PHP_EXT );
require_once( __DIR__."Page.class.".PHP_EXT );
require_once( __DIR__."Language.class.".PHP_EXT );
require_once( __DIR__."Model.class.".PHP_EXT );
require_once( __DIR__."Element.class.".PHP_EXT );

?>
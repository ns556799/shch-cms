<?php

class Utility_Controller extends Page_Controller {
	
	private static $url_handlers = array(
		'debug/$state' => 'setdebug',
	);		
	
	private static $allowed_actions = array (
		/**
		* array (
		*     'action', // anyone can access this action
		*     'action' => true, // same as above
		*     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		*     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		* );	
		**/
		//'contactForm', // anyone can access this action
		//'contactFormProcess' => true, // same as above
		'forceerror' => 'ADMIN',
		'info' => 'ADMIN',
		'sendemail' => 'ADMIN',
		'setdebug', // => 'ADMIN', - allow anyone for now
		'debug7dots'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}
	
	public function forceerror() {
		//show output on screen
		Director::set_environment_type("dev");
		//this causes a warning
		echo 1/0;	
		//this causes an error
		throw new Exception('Error testing - ignore');
	}
	
	public function info() {
		phpinfo();	
	}	
	
	public function sendemail(){
		$plainBody[] = "Test email.";
		$plainBody = implode(" \r\n\r\n", $plainBody);	
		$email = new Email();
		$email->setTo(ADMIN_EMAIL_TO); 
		$email->setFrom(ADMIN_EMAIL_FROM);         
		$email->setSubject("Test email");
		$email->setBody($plainBody);
		$email->sendPlain();	
		echo "email sent";
	}
	
	public function debug7dots(){
		$debug = array();
		if($oMember = Member::currentUser()) $debug[] = "member: ".$oMember->ID;
		$debug[] = "session: ".session_id();
		$debug[] = "classname: ".Controller::curr()->ClassName;
		$debug[] = "uri: ".$_SERVER["REQUEST_URI"];
		$debug[] = "mode: ".Director::get_environment_type();
		$debug[] = "stage: ".Versioned::get_reading_mode();			
		return implode(" | ", $debug);
	}

    public function setdebug() {
        if($this->getRequest()->param("state") == "true") {
            Cookie::set($name = "debug", $value = true, $expiry = 90, $path = NULL, $domain = NULL, $secure = false, $httpOnly = false);
			echo "Debug mode: ON";
        }elseif($this->getRequest()->param("state") == "false"){
            Cookie::set($name = "debug", $value = "");
			echo "Debug mode: OFF";
		}
    }

    public function isDebugMode() {
		//if(Permission::check("CMS_ACCESS") && Cookie::get("debug")){
		if(Cookie::get("debug")){			
			return true;
		}		
    }
	
	public static function customThrow404($class = NULL, $lineNumber = NULL){
		if(singleton("Utility_Controller")->isDebugMode()){
			echo "404 : ".$class." line: ".$lineNumber;
			exit;
		}else{
			throw new SS_HTTPResponse_Exception(ErrorPage::response_for(404), 404);
		}
	}
	
}
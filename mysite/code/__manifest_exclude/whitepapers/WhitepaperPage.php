<?php
class WhitepaperPage extends Page {

	static $icon = 'mysite/images/icons/document';	
	static $singular_name = "Whitepaper";
   	static $plural_name = "Whitepapers" ;
	//static $description = 'The default page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "Page";
	
	private static $db = array(
		"Gated" => "Boolean",
	);

	private static $has_one = array(
		"Document" => "File"
	);
	
	private static $defaults = array (
		"ContactFormToggle" => "Inline",
		"ShowInMenus" => false,
		"ShowInResourcesSearch" => true
	);		
	
	//must include this function to override default on Page class
	function canDelete($member = NULL) {
		return true;
	}   

	//must include this function to override default on Page class
	function canCreate($member = NULL) {
		return true; //switch to true when you copy
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab("Root.Document", new CheckboxField('Gated','Gated - show contact form (tracked if gated)'));

		$fields->addFieldToTab("Root.Document", $fldDocument = new UploadField('Document','Upload whitepaper'));
		//$fldDocument->getValidator()->setAllowedExtensions(array('pdf'));
		$fldDocument->setAllowedFileCategories("doc");
		$fldDocument->setFolderName('Uploads/whitepapers');
		$fldDocument->getValidator()->setAllowedMaxFileSize(52428800);		

		$fields->addFieldToTab("Root.Main", $fldPubDate = new DateField("PubDate", "Publication date"), "Content");
		$fldPubDate->setConfig('showcalendar', true);

		$fields->addFieldToTab("Root.Main", $fldShortDesc = new TextAreaField("ShortDescription", "Short description"), "Content");	
		$fldShortDesc->setRows(5);
		
		return $fields;
	}

	public function getOtherWhitepapers($limit = NULL) {

		$where = array();

		$where[] = "`SiteTree`.`ID` <> ".$this->ID;
		
		$where = implode(" AND ", $where);

		$oWhitepaperPages = WhitepaperPage::get()->where($where)->sort(array("PubDate" => "DESC"))->limit($limit);
		
		return $oWhitepaperPages;
	}		
	
	
}

class WhitepaperPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public function index() {
		return $this;
	}	
	
	public static $allowed_actions = array (
		'thankyou',
		'registerForm',
		'registerFormProcess',
		'LoginForm',
		'download'		
	);	

	public function getDownloadBox(){
		if($this->DocumentID){ //don't do anything if there isn't an attached document to download
			if($this->showDownloadLink()){
				$data = array();
				$data['Document'] = $this->Document();
				return $this->customise($data)->renderWith('WhitepaperDownload');
			}else{
				$data = array();
				$data['RegisterForm'] = $this->registerForm();
				
				$oLoginForm = $this->LoginForm();
				//$oLoginForm->getValidator()->setJavascriptValidationHandler('none');
				$oLoginForm->fields->push(new HiddenField("BackURL","BackURL",$this->Link("thankyou")));
				$data['LoginForm'] = $oLoginForm;
				return $this->customise($data)->renderWith('WhitepaperRegister');
				//return $this->registerForm();	
			}
		}
	}

	
	function registerForm(){

		//$fields = MemberPage_Controller::registerFormFieldSet(); //keep this separate to make it easier for local variations
		$fields = singleton("MemberPage_Controller")->registerFormFieldSet(); //keep this separate to make it easier for local variations

		//$member = Member::currentUser();

		$fldPasswordHelp = new LiteralField('fldPasswordHelp','<h4 style="margin: 40px 0 20px;">Enter a password if you would like to register your details for future visits.</h4>');
		$fields->push($fldPasswordHelp);

		$fldPassword = new PasswordField('Password','Password *');
		$fldPassword->setMaxLength(15);
		$fldPassword->addExtraClass('required');
		$fields->push($fldPassword);

		$fldPasswordConfirm = new PasswordField('PasswordConfirm','Confirm Password *');
		$fldPasswordConfirm->setMaxLength(15);
		$fldPasswordConfirm->addExtraClass('required');
		$fields->push($fldPasswordConfirm);
		
		//$fields->push(new HiddenField("BackURL","BackURL",$this->Link("thankyou")));			
			
		$required = new RequiredFields(

		);
			
		$actions = new FieldList(
			new FormAction("registerFormProcess", _t("Forms.BtnSubmit","Submit"))
		);

		//revert to the standard Form for debugging
		$formDetails = new WhitepaperForm($this, "registerForm", $fields, $actions, $required);
		//$formDetails = new Form($this, "registerForm", $fields, $actions, $required);
		//$formDetails->getValidator()->setJavascriptValidationHandler('none');
		
		//load previous values
		$data = Session::get("FormInfo.registerForm.data"); 
		if(is_array($data)) {
			$formDetails->loadDataFrom($data);
		} 
		
		return $formDetails;			
	
	}	
	
	public function registerFormProcess(array $data, Form $form) {

		$dataForSF = $data;

		$guestID = "";
		$memberID = "";

		//ensure all mandatory fields are entered
		if(!$data['Salutation'] || !$data['FirstName'] || !$data['Surname'] || !$data['Email'] || !$data['JobTitle'] || !$data['Company']){
			$form->sessionMessage(_t('FormsMsg.MandatoryFields',"Please ensure you have entered all mandatory fields."), 'error');
			//$form->sessionMessage('The email address <strong>'.$data['Email'].'</strong> is already in use by someone else.', 'error');
			Session::set("FormInfo.registerForm.data", $data); 
			return Controller::curr()->redirectBack();
		}	

		//check if a password has been submitted - if so, they are trying to register...
		if($data['Password'] != '' || ($data['PasswordConfirm'] )){

			//Check email is unique				
			if(!MemberPage_Controller::checkUniqueEmail($data['Email'])){
				$form->sessionMessage(sprintf(
					_t('FormsMsg.DuplicateEmail',"The email address <strong>%s</strong> is already in use by someone else."),
					$data['Email']
				), 'error');
				Session::set("FormInfo.registerForm.data", $data); 
				return Controller::curr()->redirectBack();
			}	
	
			// It does... lets see if they've added a password and matching confirmation password
			if($data['Password'] == '' || ($data['Password'] != $data['PasswordConfirm'])){
				$form->sessionMessage(_t('FormsMsg.PasswordsNotMatch','Error - please ensure your passwords match.'), 'error');
				//put the data in the session so values not cleared.
				Session::set("FormInfo.registerForm.data", $data); 
				return Controller::curr()->redirectBack();
			}
				
			//Check password is strong enough
			if(!MemberPage_Controller::checkPasswordValid($data['Password'])){
				$form->sessionMessage(_t('FormsMsg.PasswordInvalid','Error - the password entered must be 8-16 characters in length.'), 'error');
				Session::set("FormInfo.registerForm.data", $data); 
				return Controller::curr()->redirectBack();
			}					
				
			// Add a new member and automatically log them in
			if($member = MemberPage_Controller::addMember($data, $form)) {
				//clear the session data
				$data = Session::set("FormInfo.registerForm.data", ""); 
				Cookie::set("guestid","");
				if(!$member->NeedsValidation){ //could check against the member or the page...should be the same at this point
					$member->logIn(true);
					$memberID = $member->ID;
				}
			} else {
				$form->sessionMessage('Error adding user', 'error');
				//put the data in the session so values not cleared.
				Session::set("FormInfo.registerForm.data", $data); 
				return Controller::curr()->redirectBack();
				//return $this->redirectBack();
			}
			
		}else{

			$oTrackedGuest = new TrackedGuest();
			$form->saveInto($oTrackedGuest);
			$oTrackedGuest->write();
			$guestID = $oTrackedGuest->ID;
			Cookie::set("guestid", $guestID, 1, null, null, false, true);			
			
		}
		
		$pixel = "";
		
		Session::set("thankyoumsg", "<p>Thanks for submitting your details!</p>".$pixel); 
		return Controller::curr()->redirect($this->Link()."thankyou#download");

	}		
	
	//overrides the one in Page.php
	public function thankyou(){
		$this->ThankYouMessage = Session::get("thankyoumsg");
		Session::clear("thankyoumsg");
		
		return $this;	
	}
	
	public function showDownloadLink(){
		//could use this function to make a more robust/secure thankyou page
		$controllerAction = Controller::curr()->getRequest()->param('Action');
		
		if( $controllerAction == "thankyou" || !$this->Gated || $this->getCurrentGuest() || $this->getLoggedInMember()){
			return true;
		}
		return false;	
	}
	
	// **************************************
	// Download tracking and serving of files
	// **************************************
	
	//track downloads
	public function download(){
		//SecureFileController is useful...

		$bServeFile = false;
		$bIsLoggedIn = false;

		$oMember = Member::currentUser();
		if(!$this->DocumentID) return $this->httpError(404); //no download on this page
		
		//check if there is a download 
		if($this->Gated){
			$bRequiresTracking = true;
		}else{
			$bRequiresTracking = false;
		}
		
		if($oMember){ //check if the user is logged in (pURL user)
			$bIsLoggedIn = true;
			$bServeFile = true;
		}elseif(Cookie::get("guestid")){ //check if the user has a cookie stored already
			$bServeFile = true;
		}elseif(!$bRequiresTracking){ //serve file up if no tracking required
			$bServeFile = true;
		}else{	//requires tracking, but not logged in or completed form - still serve
			$bServeFile = true;
		}

		if($bServeFile){ //if all ok, serve up the file
			//$file = File::find($file_path);
			if($oMember){
				return $this->serveFileAndRecord($oMember->ID, NULL, true);
			}elseif(Cookie::get("guestid")){
				return $this->serveFileAndRecord(NULL, Cookie::get("guestid"), true);
			}elseif($bRequiresTracking) {
				return $this->serveFileAndRecord(NULL, NULL, true);
			}elseif(!$bRequiresTracking) {
				return $this->serveFileAndRecord(NULL, NULL, false);
			}
		}
		
		echo "Invalid request";	
		
	}
	
	function serveFileAndRecord($memberID, $guestID, $bRecord = true){
		if($oFile = $this->Document()){
			if($oFile instanceof File){
				$oTrackedEvent = new TrackedEvent();
				if($memberID){
					$oTrackedEvent->MemberID = $memberID;
					$oUser = DataObject::get_by_id("Member", $memberID);
				}elseif($guestID){
					$oTrackedEvent->TrackedGuestID = $guestID;
					$oUser = DataObject::get_by_id("TrackedGuest", $guestID);
				}
				
				if(isset($oUser)){
					//$oUser->LeadSource = $this->Title.$this->obj("Date")->format("Ym"); //7dots:: page title and date
					$oUser->Activity = "whitepaper";
				}
				
				$oTrackedEvent->DownloadID = $this->DocumentID;
				$oTrackedEvent->PageID = $this->ID;
				$oTrackedEvent->Action = "Download whitepaper";
				$oTrackedEvent->Details = $this->Title;
				$oTrackedEvent->PageURL = $this->AbsoluteLink();
				$oTrackedEvent->FileName = $oFile->getAbsoluteURL();
				$oTrackedEvent->IP = Controller::curr()->getRequest()->getIP();;
				$oTrackedEvent->write();

				return $this->fileFound($oFile);
			}
		}
	}
	
	function fileFound(File $file, $alternate_path = null) {
		
		// File properties
		$file_name = $file->Name;
		$file_path = Director::getAbsFile($alternate_path ? $alternate_path : $file->FullPath);
		$file_size = filesize($file_path);
		
		if(ClassInfo::exists('SS_HTTPRequest')) {
			return SS_HTTPRequest::send_file(file_get_contents($file_path), $file_name);
		} else {
			return HTTPRequest::send_file(file_get_contents($file_path), $file_name);
		}
	}		
	
}
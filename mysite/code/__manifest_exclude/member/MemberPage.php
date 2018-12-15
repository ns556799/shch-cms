<?php
class MemberPage extends Page {


	static $icon = 'mysite/images/icons/memberpage';	
	static $singular_name = "User profile page";
   	static $plural_name = "User profile pages" ;
	//static $description = 'The default page';
	//static $allowed_children = array("SiteTree"); //"none";
	//static $default_child = "Page";
	
	private static $db = array(

		'Salutation' => 'Varchar(255)',
		'Industry' => 'Text',
		
		"RequiresEmailValidation" => "Boolean",

		//"LoginHeadingContent" => "HTMLText",
		//"LoginRegisterContent" => "HTMLText",
		
	);

	public static $has_one = array(
		"RegisterToGroup" => "Group"		
	);
	
	function canDelete($member = NULL) {
		return true;
	}   
	
	function canCreate($member = NULL) {
		return true; //!DataObject::get_one("MemberPage");
	} 	
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab("Root.FormOptions", new TextField("Salutation", "Salutation / title, e.g. Mrs (comma separated list of options)"));
		$fields->addFieldToTab("Root.FormOptions", new TextField("Industry", "Industries , e.g. Agency, Education, Financial Services... (comma separated list of options)"));
		//$fields->addFieldToTab("Root.Content.Register", new CheckboxField('RequiresEmailValidation','Tick for validation of email address before allowing login.'));
		$fields->addFieldToTab("Root.Register", $fldContent2 = new HTMLEditorField('Content2','Pre-registration content'));
		$fldContent2->setRows(5);
		
		$fields->addFieldToTab("Root.Register", $fldContent3 = new HTMLEditorField('Content3','Thank you content'));
		$fldContent3->setRows(5);
		
		$oGroups = Group::get();
		$oGroups = $oGroups->Map('ID', 'Title', '--please select--');	//id, function name for value, no selection
		$fldRegisterToGroupID = new DropdownField("RegisterToGroupID", "Select security group to register new users to", $oGroups);
		$fldRegisterToGroupID->addExtraClass('required');		
		$fields->addFieldToTab("Root.Register", $fldRegisterToGroupID);
		
		return $fields;
	}
	
}

class MemberPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}
	
	public static $allowed_actions = array (
		'index',
		'logout',
		'login',
		'LoginForm',
		'registerForm',
		'registerFormProcess',
		'profileForm',
		'profileFormProcess',
		'confirm',
	);	
	
	public function index() {
		$data = $this; //parent::index();
		$mode = Member::currentUser() ? 'profile' : 'register';
		$data->Form = $this->{$mode."Form"}();
		//$data->Form = $this->registerForm();
		
		$data->ThankYou = Session::get("registerFormMsg");
		Session::set("registerFormMsg", "");
		if($data->ThankYou != ""){
			$data->Form = "";
			$data->Content = $this->Content3; //now using a CMS message
		}
		return $this->customise($data)->renderWith(array($this->ClassName.'_'.$mode, 'Page'));
	}		
	
	public function login() {
		$data = $this; //parent::index();
		$data->Title = "Log in";
		$data->Form = $this->LoginForm();
		//$data->Form = $this->registerForm();
		return $this->customise($data)->renderWith(array('MemberPage_login', 'Page'));
	}		
	
	function logout() {
   		Security::logout(false);
   		//return Director::redirect("/");
		return Controller::curr()->redirect("/");
	}	

	function registerForm(){

		$fields = $this->registerFormFieldSet(); //keep this separate to make it easier for local variations

		$fldPassword = new PasswordField('Password','Password *');
		$fldPassword->setMaxLength(15);
		$fldPassword->addExtraClass('required');
		$fields->push($fldPassword);

		$fldPasswordConfirm = new PasswordField('PasswordConfirm','Confirm Password *');
		$fldPasswordConfirm->setMaxLength(15);
		$fldPasswordConfirm->addExtraClass('required');
		$fields->push($fldPasswordConfirm);
		
		$fldTrackedGuestID = new HiddenField("TrackedGuestID","TrackedGuestID","");
		$fields->push($fldTrackedGuestID);
			
		$required = new RequiredFields(

		);
			
		$actions = new FieldList(
			new FormAction("registerFormProcess", _t("Forms.BtnSubmit","Submit"))
		);

		//revert to the standard Form for debugging
		$formDetails = new RegisterForm($this, "registerForm", $fields, $actions, $required);
		//$formDetails = new Form($this, "registerForm", $fields, $actions, $required);
		//$formDetails->getValidator()->setJavascriptValidationHandler('none');
		
		//load previous values
		if($data = Session::get("FormInfo.registerForm.data")){
			if(is_array($data)) {
				$formDetails->loadDataFrom($data);
			} 
		}elseif($oGuest = $this->getCurrentGuest()){
			$oGuest->TrackedGuestID = $oGuest->ID; //useful to know if guest subsequently registered
			$formDetails->loadDataFrom($oGuest);
		}
		
		return $formDetails;			
	
	}	
	
	public function registerFormFieldSet(){
		
		$oMemberPage = $this->getAccountPage();
		
		$titleList = $oMemberPage->Salutation;
		$titleList = explode(",",$titleList);
		$titleArr = array(); //need to do this to set the indexes correctly as not an object (not very elegant...)
		foreach($titleList as $title){
			$titleArr[trim($title)] = trim($title);
		}
		$fieldTitle = new DropdownField("Salutation", "Title *",$titleArr);
		$fieldTitle->SetEmptyString(_t('FormLabel.PleaseSelect', '-- please select --'));	
		$fieldTitle->addExtraClass('required');
			
		$fieldFirstName = new TextField('FirstName','First name *');
		$fieldFirstName->addExtraClass('required');
		
		$fieldLastName = new TextField('Surname','Last name *');
		$fieldLastName->addExtraClass('required');
		
		$fieldPhone = new TextField('Phone','Phone');
		//$fieldPhone->addExtraClass('required');

		$fieldEmail = new TextField('Email','Email address *');
		$fieldEmail->addExtraClass('required email');			

		$fieldJobTitle = new TextField('JobTitle','Job title *');
		$fieldJobTitle->addExtraClass('required');

		$fieldJobCompany = new TextField('Company','Company *');
		$fieldJobCompany->addExtraClass('required');
		
		//$fieldIndustry = new TextField('Industry','Industry *');
		//$fieldIndustry->addExtraClass('required');		

		$industryList = $oMemberPage->Industry;
		$industryList = explode(",",$industryList);
		$industryArr = array(); //need to do this to set the indexes correctly as not an object (not very elegant...)
		foreach($industryList as $industry){
			$industryArr[trim($industry)] = trim($industry);
		}
		$fieldIndustry = new DropdownField("Industry", "Industry",$industryArr);
		$fieldIndustry->SetEmptyString(_t('FormLabel.PleaseSelect', '-- please select --'));	
		//$fieldIndustry->addExtraClass('required');

		//$recaptchaField = new RecaptchaField('Captcha');
		//$recaptchaField->jsOptions = array('theme' => 'clean'); // optional
		
		$newsletterField = new CheckboxField("Newsletter", 'Sign me up to the newsletter', 1);
		//$dpa1Field->addExtraClass('required');

		//$sourceField = new HiddenField("SignUpSource","SignUpSource",$this->getSignUpSource());

		//$backURLField = new HiddenField("BackURL","BackURL",$this->getBackURL());
			
		$fields = new FieldList(
			$fieldTitle,
			$fieldFirstName,
			$fieldLastName,
			$fieldPhone,
			$fieldEmail,
			$fieldJobTitle,
			$fieldJobCompany,
			$fieldIndustry,
			$newsletterField
			//$sourceField,
			//$backURLField
		);	
		
		return $fields;
	
		
	}
	
	public function registerFormProcess(array $data, Form $form) {

		//ensure all mandatory fields are entered
		if(!$data['Salutation'] || !$data['FirstName'] || !$data['Surname'] || !$data['Email'] || !$data['JobTitle'] || !$data['Company']){
			$form->sessionMessage(_t('FormsMsg.MandatoryFields',"Please ensure you have entered all mandatory fields."), 'error');
			//$form->sessionMessage('The email address <strong>'.$data['Email'].'</strong> is already in use by someone else.', 'error');
			Session::set("FormInfo.registerForm.data", $data); 
			return Controller::curr()->redirectBack();
		}	

		//Check email is unique				
		if(!$this->checkUniqueEmail($data['Email'])){
			$form->sessionMessage(sprintf(
				_t('FormsMsg.DuplicateEmail',"The email address %s is already in use by someone else."),
				$data['Email']
			), 'error');
			//$form->sessionMessage('The email address <strong>'.$data['Email'].'</strong> is already in use by someone else.', 'error');
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
		if(!$this->checkPasswordValid($data['Password'])){
			$form->sessionMessage(_t('FormsMsg.PasswordInvalid','Error - the password entered must be 8-16 characters in length.'), 'error');
			Session::set("FormInfo.registerForm.data", $data); 
			return Controller::curr()->redirectBack();
		}					
			
		// Add a new member and automatically log them in
		if($member = $this->addMember($data, $form)) {

			//clear the session data
			$data = Session::set("FormInfo.registerForm.data",""); 
			Cookie::set("guestid","");
			if(!$member->NeedsValidation){ //could check against the member or the page...should be the same at this point
				$member->logIn(true);
			}
		} else {
			$form->sessionMessage('Error adding user', 'error');
			//put the data in the session so values not cleared.
			Session::set("FormInfo.registerForm.data", $data); 
			return Controller::curr()->redirectBack();
			//return $this->redirectBack();
		}
		
		$data["Activity"] = "registration";
		$data["LeadSource"] = "registration";

		$pixel = "";

		//$form->sessionMessage('Thanks for signing up!'.$pixel, 'success');
		Session::set("registerFormMsg", "<p>Thank you for registering. You can now use your email address and login for any future visits.</p>".$pixel); 
		return Controller::curr()->redirectBack();

	}

	/**
	* Handle adding a site member if option is set and 
	**/
	public function addMember($data, $form) {
		
		if(!$oMemberPage = $this->getAccountPage()) return false;
		
		if(!isset($data['Email'])) return false;
		
		if(!MemberPage_Controller::checkUniqueEmail($data['Email'])){
			return false;	
		}
		
		// Create a member object
		$member = new Member();
		//$member->SubsiteID = $this->getCurrentSubsiteID();
		// Save form in to member object
		$form->saveInto($member);
		// Handle a couple of fields named differently in the SignUpDataObject
		if($oMemberPage->RequiresEmailValidation){ //member needs to validate email address before logging in.
			$member->NeedsValidation = 1;
			//$member->ValidationKey = //set by default on member
		}
		
		// Attempt to write the user
		try {
			$member->write();
		} catch(ValidationException $e) {
			
			echo "duplicate email address?".$e->getResult()->message();
			exit;
			
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return Controller::curr()->redirectBack();
		}

		// Set the group after member is created otherwise the member object does not exist
		if($oMemberPage->RegisterToGroupID > 0){
			$member->Groups()->setByIDList(array($oMemberPage->RegisterToGroupID));
		}

		//TO DO :: we should email registered members regardless of validation
		if($member->NeedsValidation){
			
			$BackURL = "";
			if(isset($data['BackURL']) && $data['BackURL'] != ""){
				//add the backURL to the email	
				$BackURL = $data['BackURL'];
			}
			//$email = new MemberConfirmationEmail($this, $member);
			
			$emailContent = new DataObjectSet();
			$emailContent->Membername = $member->FirstName;
			$emailContent->ConfirmLink = Director::absoluteURL($this->getSubsiteLink())."confirm/".$member->ID."/?key=".$member->ValidationKey;
			if($BackURL != "") $emailContent->ConfirmLink = $emailContent->ConfirmLink."&BackURL=".$BackURL;

			//store this in case they need it resending
			$member->ValidationLink = $emailContent->ConfirmLink;
			$member->write();

			$emailContent->LoginLink = Director::absoluteURL(Security::Link('login'));
			$emailContent->LostPasswordLink = Director::absoluteURL(Security::Link('lostpassword'));
			
			$email = new Email();
			$email->setTemplate('MemberValidationEmail');
			$email->setTo($member->Email); 
			$email->setFrom("no-reply@lcpconsulting.com");         
			$email->setSubject('Member activation for lcpconsulting.com');
			$email->populateTemplate($emailContent);
			
			//return str_replace(array_keys($variables), array_values($variables), $string);
			$email->send();			
			
		}
		
		//add the lead source to the new user
		//Page::updateUserLeadSource($member);
		
		$this->extend('onAddMember', $member);
		return $member;
	}	
	
	function profileForm(){
		
		//check they are a member
		if(!$member = Member::currentUser()) return false;
		
		$fields = $this->profileFormFieldSet();
			
		$required = new RequiredFields(
		);
			
		$actions = new FieldList(
			new FormAction("profileFormProcess", _t("Forms.BtnSubmit","Submit"))
		);

		//revert to the standard Form for debugging
		//$formDetails = new USProfileForm($this, "profileForm", $fields, $actions, $required);
		$formDetails = new ProfileForm($this, "profileForm", $fields, $actions, $required);
		//$formDetails = new Form($this, "registerForm", $fields, $actions, $required);
		//$formDetails->getValidator()->setJavascriptValidationHandler('none');
		$formDetails->loadDataFrom($member);
		
		return $formDetails;			
	
	}		
	
	public function profileFormFieldSet(){
	
		if(!$member = Member::currentUser()) return false;
	
		$fieldEmail = new TextField('Email','Email address *');
		$fieldEmail->addExtraClass('required email');			

		$fldMemberID = new HiddenField("MemberID","MemberID",$member->ID);

		$fldPassword = new PasswordField('Password','Password *');
		$fldPassword->setMaxLength(15);
		$fldPassword->addExtraClass('required');

		$fldPasswordConfirm = new PasswordField('PasswordConfirm','Confirm Password *');
		$fldPasswordConfirm->setMaxLength(15);
		$fldPasswordConfirm->addExtraClass('required');

		$fldNewsletter = new CheckboxField("Newsletter", 'Sign me up to the newsletter (remove this before go-live)');
			
		$fields = new FieldList(
			$fieldEmail,
			//new LiteralField("LiteralContent2", "Change your password"),
			$fldPassword,
			$fldPasswordConfirm,
			$fldNewsletter,
			$fldMemberID
		);
		
		return $fields;
	
	}	
	
	public function profileFormProcess(array $data, Form $form) {

		$member = Member::currentUser();

		if(!$member){
			$form->sessionMessage('Login expired. Please try again...', 'error');
			return Controller::curr()->redirectBack();
		}
		
		//belt and braces - check user logged in
		if(isset($data['MemberID']) && is_numeric($data['MemberID']) && ($member->ID == $data['MemberID']) ){


			//Check email is unique				
			if(!$this->checkUniqueEmail($data['Email'])){
				$form->sessionMessage(sprintf(
					_t('FormsMsg.DuplicateEmail',"The email address <strong>%s</strong> is already in use by someone else."),
					$data['Email']
				), 'error');
				return Controller::curr()->redirectBack();
			}	
	
			// It does... lets see if they've added a password and matching confirmation password
			if($data['Password'] != '' && ($data['Password'] != $data['PasswordConfirm'])){
				$form->sessionMessage(_t('FormsMsg.PasswordsNotMatch','Error - please ensure your passwords match.'), 'error');
				return Controller::curr()->redirectBack();
			}
			
			//Check password is strong enough
			if($data['Password'] != '' && !$this->checkPasswordValid($data['Password'])){
				$form->sessionMessage(_t('FormsMsg.PasswordInvalid','Error - the password entered must be 8-16 characters in length.'), 'error');
				return Controller::curr()->redirectBack();
			}elseif($data['Password'] != '' && $this->checkPasswordValid($data['Password'])){
				$member->Password = $data['Password'];
			}
			
			$member->Email = $data['Email'];
			if(isset($data['Newsletter'])){
				$member->Newsletter = 1;
			}else{
				$member->Newsletter = 0;
			}
			//$form->saveInto($member); //removes password if blank...
			
			Page::updateUserLeadSource($member);		
			
			$member->write();

			//work out where to redirect them
			$form->sessionMessage(_t('FormsMsg.DetailsUpdated','Your details have been updated successfully!'), 'success');
			return Controller::curr()->redirectBack();
		}
	}
	
	public function checkUniqueEmail($email){
		
		if(!$email) return false;
		
		$filter = array();
		$filter[] = "`Email`='".Convert::raw2sql($email)."'";
		
		//if the user is logged in, exclude their Member from the check
		if($member = Member::currentUser()){
			$filter[] = "`ID` <> '".$member->ID."'";
		}
		
		$filter = implode(" AND ",$filter);
		
		if($oMember = DataObject::get_one("Member", $filter)){
			return false; //already a member with this email
		}else{
			return true;
		}
		
	}
	
	public function checkPasswordValid($password){
		if(
			ctype_alnum($password) // numbers & digits only
			&& strlen($password) > 7 // at least 8 chars
			&& strlen($password) < 17 // at most 16 chars
			//&& preg_match('`[A-Za-z]`',$password) // at least one letter
			//&& preg_match('`[A-Z]`',$password) // at least one upper case
			//&& preg_match('`[a-z]`',$password) // at least one lower case
			//&& preg_match('`[0-9]`',$password) // at least one digit
			&& preg_match('`[A-Za-z0-9]`',$password) //numbers and letters only
		){
			return true;
		}else{
			return false;
		} 

	}
	
	
}

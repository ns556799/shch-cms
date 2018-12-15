<?php
class CustomLoginForm extends MemberLoginForm
{
	public function dologin($data) {	
		if($this->performLogin($data)) {
			Session::clear('SessionForms.MemberLoginForm.Email');
			Session::clear('SessionForms.MemberLoginForm.Remember');
	
			if(Member::currentUser()->isPasswordExpired()) {
				if(isset($_REQUEST['BackURL']) && $backURL = $_REQUEST['BackURL']) {
					Session::set('BackURL', $backURL);
				}
				$cp = new ChangePasswordForm($this->controller, 'ChangePasswordForm');
				$cp->sessionMessage('Your password has expired. Please choose a new one.', 'good');
				return $this->controller->redirect('Security/changepassword');
			}
			
			//7dots::see if the user is in a group to decide where to redirect
			$groupRedirectURL = $this->groupRedirectURL();
			if($groupRedirectURL) {
				//Director::redirect($groupRedirectURL);
					 
				
				return $this->controller->redirect($groupRedirectURL);
			}
			//End
			
			// Absolute redirection URLs may cause spoofing
			if(isset($_REQUEST['BackURL']) && $_REQUEST['BackURL'] && Director::is_site_url($_REQUEST['BackURL']) ) {
				return $this->controller->redirect($_REQUEST['BackURL']);
			}
	
			// Spoofing attack, redirect to homepage instead of spoofing url
			if(isset($_REQUEST['BackURL']) && $_REQUEST['BackURL'] && !Director::is_site_url($_REQUEST['BackURL'])) {
				return $this->controller->redirect(Director::absoluteBaseURL());
			}
	
			// If a default login dest has been set, redirect to that.
			if (Security::default_login_dest()) {
				return $this->controller->redirect(Director::absoluteBaseURL() . Security::default_login_dest());
			}
	
			// Redirect the user to the page where he came from
			$member = Member::currentUser();
			if($member) {
				
				$firstname = Convert::raw2xml($member->FirstName);
				if(!empty($data['Remember'])) {
					Session::set('SessionForms.MemberLoginForm.Remember', '1');
					$member->logIn(true);
				} else {
					$member->logIn();
				}
	
				Session::set('Security.Message.message',
					_t('Member.WELCOMEBACK', "Welcome Back, {firstname}", array('firstname' => $firstname))
				);
				Session::set("Security.Message.type", "good");
			}
						
			Controller::curr()->redirectBack();
			
			
		} else {
			if(array_key_exists('Email', $data)){
				Session::set('SessionForms.MemberLoginForm.Email', $data['Email']);
				Session::set('SessionForms.MemberLoginForm.Remember', isset($data['Remember']));
			}

			if(isset($_REQUEST['BackURL'])) $backURL = $_REQUEST['BackURL']; 
			else $backURL = null; 

			if($backURL) Session::set('BackURL', $backURL);
			
			if($badLoginURL = Session::get("BadLoginURL")) {
				$this->controller->redirect($badLoginURL);
			} else {
				// Show the right tab on failed login
				$loginLink = Director::absoluteURL($this->controller->Link('login'));
				if($backURL) $loginLink .= '?BackURL=' . urlencode($backURL);
				$this->controller->redirect($loginLink . '#' . $this->FormName() .'_tab');
			}
		}	
	}
	
    public function groupRedirectURL()
    {  
        // gets the current member that is logging in
        $member = Member::currentUser();

        // gets all the groups.
		$Groups = Group::get();
        //$Groups = DataObject::get("Group");
		
		//if the base URL is "/" we end up with an extra slash in the 
		$baseURL = Director::baseURL() == "/" ? "" : Director::baseURL() ;
		
        //cycle through each group 
        foreach($Groups as $Group)
        {
			
            //if the member is in the group and that group has GoToAdmin checked
            if($member && $member->inGroup($Group->ID) && $Group->GoToAdmin)
			{  
               //redirect to the admin page
				return $baseURL.'/admin';
            }
            //otherwise if the member is in the group and that group has a page linked
            elseif($member && $member->inGroup($Group->ID)  && $Page = $Group->LinkedPage())
            {  
                //direct to that page if it's been set (if not it will have an id of 0 which is the SiteTree)
				if($Page->ID != 0){
					$config = SiteConfig::current_site_config();
					if($config->ReplyEmail){
						$From = $config->ReplyEmail;
					}else{
						$From = "webmaster@7dots.co.uk";
					}
					if($config->NotificationEmail){
						$To = $config->NotificationEmail;
					}else{
						$To = "webmaster@7dots.co.uk";
					}
					$Subject = " ".$Group->Title;     
					$email = new Email($From, $To, $Subject);
					$email->setTemplate('EmailLogIn');
					$email->populateTemplate(array(
						'Member' => $member,
						'CompanyName' => $Group->Title,
						'Timestamp' => date("Y-m-d H:i:s")
					));
					$email->send();  
					
	                return $baseURL.$Page->Link();        
				}
            }
        }

        return false;
    }	
}
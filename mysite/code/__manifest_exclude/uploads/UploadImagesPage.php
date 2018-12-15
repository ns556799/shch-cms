<?php
class UploadImagesPage extends Page {
	
	static $icon = 'mysite/images/icons/uploadimage';	
	
	private static $db = array(
	);
	
	private static $has_one = array(
	);
	
	function canDelete($member = NULL) { //prevent deletion
		return false;
	}   
	
	function canCreate($member = NULL) { //only one in the site tree
		return !(UploadImagesPage::get()->Count() > 0);
	} 		
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab("Root.Tips", new HTMLEditorField("Content2", "Tips for uploading (right column"));
		
		return $fields;
	}
	
}

class UploadImagesPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
	}

	static $maxImages = 10;

	private static $allowed_actions = array (
		/**
		* array (
		*     'action', // anyone can access this action
		*     'action' => true, // same as above
		*     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
		*     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
		* );	
		**/
		'gallery' => true,
		'uploadImageForm' => true, // anyone can access this action
		'uploadImage' => true, // same as above
		'iframe' => true,
		'editdetails' => true,
		'editImageForm' => true, // anyone can access this action
		'editImage' => true, // same as above		
		'reportImageForm' => true, // anyone can access this action
		'reportImage' => true, // same as above		
	);	

	public function index() {
		return $this->customise($this)->renderWith(array('UploadImagesPage','Page'));	
	}
	
	public function gallery() {
		return $this->customise($this)->renderWith(array('UploadImagesPageGallery','Page'));	
	}	
	
	public function uploadImageForm() {
		
		$oCountImages = 0; //$this->getUploadedImages();
		if(count($oCountImages) < self::$maxImages){

			$fields = new FieldList(
				//new LiteralField("LiteralTitle", "<h2>Step #1 - upload your photo</h2>"),
				new TextField("Title", "Tell us about your photo: <span class='req'>*</span>", "")
				//new TextAreaField("Description", "Description: <span class='req'>*</span>", "")
				//Restricts the upload size to 2MB by default, and only allows upload of files with the extension 'jpg', 'gif' or 'png'.
				
				//is it worth trying to create a folder for each act?
				
			);

			//$fldUploadedImage = new FileField("UploadedImage", "Upload an image: <span class='req'>*</span>", "", "", "", "Uploads/uploadedimages");
			$fldUploadedImage = new FileField("UploadedImage", "Upload an image: <span class='req'>*</span>");
			$fldUploadedImage->getValidator()->setAllowedExtensions(array('gif','jpg','jpeg'));
			$fldUploadedImage->setFolderName("Uploads/uploadedimages");
			$fields->push($fldUploadedImage);
			
			
			$required = new RequiredFields(
				//"Description",
				"UploadedImage"
			);
	
			$actions = new FieldList(
				//new FormAction("uploadImage", "Upload an image","","","uploadimage")
				new FormAction("uploadImage", "Submit")
			);
			
			$form = new CustomForm($this, "uploadImageForm", $fields, $actions, $required);	
		
			return $form;
			
		}
	}
	
	function uploadImage($data,$form) {	
		if($oMember = Member::currentUser()){
			$oUploadedImage = new UploadedImage();
			$form->saveInto($oUploadedImage);

			$oMember = Member::currentUser();
			
			$oUploadedImage->MemberID = $oMember->ID;			
			
			$oUploadedImage->write();
			$form->sessionMessage('The image has been uploaded.', 'success');
			//return Director::redirect($this->Link('Productions'));
			
			//move this to the second step where title and description are added
			//Email notification: START
			/*
			$data = array();
			$data["UploadedImage"] = $oUploadedImage;	
			$data["Member"] = $oMember;			
			
			$Subject = "Image uploaded on Energy14 by: ".$oMember->FirstName." ".$oMember->Surname." (".$oMember->Email.")";
			$email = new Email();
			$email->setTo("ed.gossage@7dots.co.uk");
			$email->setFrom("JLT Energy14 <no-reply@jltgroup.com>");         
			$email->setSubject($Subject);
			//set template
			$email->setTemplate('ImageUploaded');
			//populate template
			$email->populateTemplate($data);
			//send mail
			$email->send();	
			*/
			//Email notification: END		

			//return $this->redirectBack();
			return $this->redirect($this->Link()."editdetails/".$oUploadedImage->ID."/step2");
		}
	}	
	
	public function editdetails(){
		//if(isset($this->request->param("ID")) && is_numeric($this->request->param("ID"))){
		if(is_numeric($this->request->param("ID")) && $oMember = Member::currentUser()){
			
			if($oUploadedImage = UploadedImage::get()->Filter(array("ID" => $this->request->param("ID"), "MemberID" => $oMember->ID))->First()){
				if($oUploadedImage->detailsCompleted()){
					$data["CustomPageTitle"] = "Image details complete!";
					$data["CustomContent"] = "<p>Thank you - you have now completed your image details.</p>
												<p>You cannot edit the details you have submitted, but you may request changes or removal of the image using the form.</p>";		
					$data["getEditFormForImage"] = $this->reportImageForm();		
				}elseif($this->request->param("OtherID") == "step2"){
					$data["CustomPageTitle"] = "<em>Step 2 of 2</em> - tell us where you took the photo";
					$data["getEditFormForImage"] = $this->editImageForm();
				}else{
					$data["CustomPageTitle"] = "<em>Step 2 of 2</em> - tell us where you took the photo";
					$data["getEditFormForImage"] = $this->editImageForm();
				}
				
				$data["UploadedImage"] = $oUploadedImage;
				
				return $this->customise($data)->renderWith(array('UploadImagesPageEdit','Page'));	
			}
		}
		
		//fall back to main page if there is an issue
		return $this->index();
	}

	public function editImageForm() {

		$uploadedImageID = 0;

		if(is_numeric($this->request->param("ID")) && $oMember = Member::currentUser()){
			if($oUploadedImage = UploadedImage::get()->Filter(array("ID" => $this->request->param("ID"), "MemberID" => $oMember->ID))->First()){
				$uploadedImageID = $oUploadedImage->ID;
			}
		}
		
		$fields = new FieldList(
			new TextField("Title", "Edit your photo title: <span class='req'>*</span>", ""),
			//new TextAreaField("Description", "Description: <span class='req'>*</span>", ""),
			new LiteralField("Formmap",'<div id="map_wrap" class="white-popup mfp-hide popup-container popup-large "><div id="address_wrap"><input type="text" id="form_address" placeholder="Enter address, postcode or place of interest"><input type="button" id="form_address_find" value="Find"></div><div id="formmap"></div><div id="map_view_caption"><ul><li><strong>You can also:</strong></li><li>Click on the map to position the marker.</li><li>Markers can be dragged to adjust the position.</li></ul></div></div>'),
			new LiteralField("MapPreview",'<div id="map_preview_wrap"><input type="button" id="map_view_button" value="Add location"><div id="map_preview"></div></div>'),
			new TextField("Location", "Where did you take the photo? <span class='req'>*</span>", ""),
			new HiddenField("EditImageID", "EditImageID", $uploadedImageID),
			new HiddenField("Lat", "Lat"),
			new HiddenField("Lng", "Lng")
		);

		
		$required = new RequiredFields(
			"Title"
		);

		$actions = new FieldList(
			new FormAction("editImage", "Save")
		);
		
		
		$form = new CustomForm($this, "editImageForm", $fields, $actions, $required);	
		if($oUploadedImage) $form->loadDataFrom($oUploadedImage);
	
		return $form;
	}


	function editImage($data, $form) {	
		if($oMember = Member::currentUser()){

			if(is_numeric($data['EditImageID'])){
				if($oUploadedImage = UploadedImage::get()->Filter(array("ID" => $data['EditImageID'], "MemberID" => $oMember->ID))->First()){
					$uploadedImageID = $oUploadedImage->ID;
				}else{
					//error
					$form->sessionMessage('Error updating image.', 'error');
					return $this->redirectBack();
				}
			}
			
			$form->saveInto($oUploadedImage);
			//should we automatically set the status to unapproved if they update the details?
			$oUploadedImage->Approved = 0;
			$oUploadedImage->write();
			$form->sessionMessage('Thank you!', 'success');
			//return Director::redirect($this->Link('Productions'));
			
			//Email notification: START
			$data = array();
			$data["UploadedImage"] = $oUploadedImage;	
			$data["Member"] = $oMember;			
			
			$Subject = "Image uploaded on Energy14 by: ".$oMember->FirstName." ".$oMember->Surname." (".$oMember->Email.")";
			$email = new Email();
			$email->setTo("ed.gossage@7dots.co.uk");
			$email->setFrom("JLT Energy14 <no-reply@jltgroup.com>");         
			$email->setSubject($Subject);
			//set template
			$email->setTemplate('ImageUploaded');
			//populate template
			$email->populateTemplate($data);
			//send mail
			$email->send();	
			//Email notification: END		

			$plainBody = "Email body";

			/*
			$email = new Email();
			//$email->setBCC($this->getSiteConfig("CCAllForms")); 
			//$email->setTo($this->getEmailRecipientsForForm()); //$email->setTo($this->EmailRecipients); 
			$email->setTo("ed.gossage@7dots.co.uk");
			$email->setFrom("JLT Energy14 <no-reply@jltgroup.com>");         
			$email->setSubject($Subject);
			$email->setBody($plainBody);
			$email->sendPlain();		
			*/
			
			return $this->redirectBack();
		}
	}

	public function reportImageForm() {

		$uploadedImageID = 0;

		if(is_numeric($this->request->param("ID")) && $oMember = Member::currentUser()){
			if($oUploadedImage = UploadedImage::get()->Filter(array("ID" => $this->request->param("ID"), "MemberID" => $oMember->ID))->First()){
				$uploadedImageID = $oUploadedImage->ID;
			}
		}
		
		if(!$oMember = Member::currentUser()){
			$oMember = new Member(); //we're not saving this, just cuts down coding below
		}

		$fldRequestAction = new DropdownField("RequestAction", "What is your request? <span class='req'>*</span>", array("Remove the image" => "Remove the image", "Change the details" => "Change the details"));
		$fldRequestAction->SetEmptyString("-- please select --");	

		
		$fields = new FieldList(
			new TextField("FirstName", "First name <span class='req'>*</span>", $oMember->FirstName),
			new TextField("Surname", "Last name <span class='req'>*</span>", $oMember->Surname),
			new EmailField("Email", "Email <span class='req'>*</span>", $oMember->Email),
			$fldRequestAction,
			new TextAreaField("Reason", "Please explain the reasons for your request: <span class='req'>*</span>", ""),
			new HiddenField("EditImageID", "EditImageID", $uploadedImageID)
		);

		
		$required = new RequiredFields(
			"FirstName", "Surname", "Email", "RequestAction", "Reason", "EditImageID"
		);

		$actions = new FieldList(
			new FormAction("reportImage", "Submit")
		);
		
		
		$form = new CustomForm($this, "reportImageForm", $fields, $actions, $required);	
		if(isset($oUploadedImage)) $form->loadDataFrom($oUploadedImage);
	
		return $form;
	}


	function reportImage($data, $form) {	
		$oUploadedImage = "";
		
		if(is_numeric($data['EditImageID'])){
			if($oUploadedImage = UploadedImage::get()->Filter(array("ID" => $data['EditImageID']))->First()){
				$uploadedImageID = $oUploadedImage->ID;
			}else{
				//error
				$form->sessionMessage('Error reporting image - please try again.', 'error');
				return $this->redirectBack();
			}
		}else{
			//error
			$form->sessionMessage('Error reporting image - please try again.', 'error');
			return $this->redirectBack();
		}
			
		$form->sessionMessage('Thank you for submitting your request. We will respond shortly.', 'success');
		//return Director::redirect($this->Link('Productions'));
		
		//Email notification: START
		//$data = array();
		$data["UploadedImage"] = $oUploadedImage;	

		if($oMember = Member::currentUser() && isset($oUploadedImage)){
			if ($oMember->ID == $oUploadedImage->MemberID){
				$data['ImageOwner']	 = true;
			}
		}
	
		$Subject = "Image reported on Energy14 by: ".$data['FirstName']." ".$data['Surname']." (".$data['Email'].")";
		$email = new Email();
		$email->setTo("ed.gossage@7dots.co.uk");
		$email->setFrom("JLT Energy14 <no-reply@jltgroup.com>");         
		$email->setSubject($Subject);
		//set template
		$email->setTemplate('ImageReported');
		//populate template
		$email->populateTemplate($data);
		//send mail
		$email->send();	
		//Email notification: END		

		return $this->redirectBack();
	}


	function getUploadedImages() { 
		if(!$oMember = Member::currentUser()) return false;
		
		return UploadedImage::get()->Filter(array("MemberID" => $oMember->ID))->Sort("Created DESC");
		
		/*
		$oActPage = $this->getActPage();
		if($oActPage){
			$filter = '(ActPageID ='.$oActPage->ID.')';
			$oUploadedImages = DataObject::get('UploadedImage', $filter, '`Created` DESC', "" , 100);
			return $oUploadedImages;
		}
		*/
	}	
	
	
}
<?php
require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';

function buildContactFormConfig() {
    return [
        'masterStatus' => ['error' => false],
        'fname'    => ['type'=>'text','regex'=>'name','label'=>'First Name','name'=>'fname','id'=>'fname','errorMsg'=>'You must enter a valid first name.','error'=>'','required'=>true,'value'=>''],
        'lname'    => ['type'=>'text','regex'=>'name','label'=>'Last Name','name'=>'lname','id'=>'lname','errorMsg'=>'You must enter a valid last name.','error'=>'','required'=>true,'value'=>''],
        'address'  => ['type'=>'text','regex'=>'address','label'=>'Address','name'=>'address','id'=>'address','errorMsg'=>'Address must start with a number followed by letters.','error'=>'','required'=>true,'value'=>''],
        'city'     => ['type'=>'text','regex'=>'city','label'=>'City','name'=>'city','id'=>'city','errorMsg'=>'You must enter a valid city (letters only).','error'=>'','required'=>true,'value'=>''],
        'state'    => ['type'=>'select','label'=>'State','name'=>'state','id'=>'state','errorMsg'=>'You must select a state.','error'=>'','required'=>true,'selected'=>'','options'=>['0'=>'Please Select a State','MI'=>'Michigan','OH'=>'Ohio','IN'=>'Indiana','IL'=>'Illinois','WI'=>'Wisconsin']],
        'zip'      => ['type'=>'text','regex'=>'zip','label'=>'Zip Code','name'=>'zip','id'=>'zip','errorMsg'=>'You must enter a valid zip code (5 digits).','error'=>'','required'=>true,'value'=>''],
        'phone'    => ['type'=>'text','regex'=>'phone','label'=>'Phone','name'=>'phone','id'=>'phone','errorMsg'=>'Phone must be in the format 999.999.9999.','error'=>'','required'=>true,'value'=>''],
        'email'    => ['type'=>'text','regex'=>'email','label'=>'Email','name'=>'email','id'=>'email','errorMsg'=>'You must enter a valid email address.','error'=>'','required'=>true,'value'=>''],
        'dob'      => ['type'=>'text','regex'=>'dob','label'=>'Date of Birth','name'=>'dob','id'=>'dob','errorMsg'=>'Date of birth must be in mm/dd/yyyy format.','error'=>'','required'=>true,'value'=>''],
        'age'      => ['type'=>'radio','label'=>'Choose an Age Range','name'=>'age','id'=>'age','errorMsg'=>'You must select an age range','error'=>'','required'=>true,'options'=>[['value'=>'0-17','label'=>'0-17','checked'=>false],['value'=>'18-30','label'=>'18-30','checked'=>false],['value'=>'30-50','label'=>'30-50','checked'=>false],['value'=>'50+','label'=>'50+','checked'=>false]]],
        'contacts' => ['type'=>'checkbox','label'=>'Select One or More Options','name'=>'contacts','id'=>'contacts','error'=>'','required'=>false,'options'=>[['value'=>'newsletter','label'=>'newsletter','checked'=>false],['value'=>'email','label'=>'email','checked'=>false],['value'=>'text','label'=>'text','checked'=>false]]]
    ];
}

function processContactForm() {
    $formConfig = buildContactFormConfig();
    $stickyForm = new StickyForm();
    $acknowledgment = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $formConfig = $stickyForm->validateForm($_POST, $formConfig);

        if ($formConfig['masterStatus']['error'] === false) {
            $selectedContacts = [];
            foreach ($formConfig['contacts']['options'] as $opt) {
                if ($opt['checked']) $selectedContacts[] = $opt['value'];
            }
            $contactsValue = implode(',', $selectedContacts);

            $ageValue = '';
            foreach ($formConfig['age']['options'] as $opt) {
                if ($opt['checked']) { $ageValue = $opt['value']; break; }
            }

            $fname   = $formConfig['fname']['value'];
            $lname   = $formConfig['lname']['value'];
            $address = $formConfig['address']['value'];
            $city    = $formConfig['city']['value'];
            $state   = $formConfig['state']['selected'];
            $zip     = $formConfig['zip']['value'];
            $phone   = $formConfig['phone']['value'];
            $email   = $formConfig['email']['value'];
            $dob     = $formConfig['dob']['value'];

            $pdo = new PdoMethods();
            $sql = "INSERT INTO contacts (fname,lname,address,city,state,zip,phone,email,dob,contacts,age) VALUES (:fname,:lname,:address,:city,:state,:zip,:phone,:email,:dob,:contacts,:age)";
            $bindings = [
                [':fname',$fname,'str'],[':lname',$lname,'str'],[':address',$address,'str'],
                [':city',$city,'str'],[':state',$state,'str'],[':zip',$zip,'str'],
                [':phone',$phone,'str'],[':email',$email,'str'],[':dob',$dob,'str'],
                [':contacts',$contactsValue,'str'],[':age',$ageValue,'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'noerror') {
                $acknowledgment = '<p class="text-success">Contact Information Added</p>';
                $formConfig = buildContactFormConfig();
            } else {
                $acknowledgment = '<p class="text-danger">There was an error adding the record</p>';
            }
        }
    }

    return ['formConfig' => $formConfig, 'stickyForm' => $stickyForm, 'acknowledgment' => $acknowledgment];
}
?>
<?php
//Handles the Add Admin form, hashes the password, inserts into table


require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';

$acknowledgment = '';

function buildAdminFormConfig() {
    return [
        'masterStatus' => ['error' => false],

        'fname' => [
            'type' => 'text', 'regex' => 'name',
            'label' => 'First Name', 'name' => 'fname', 'id' => 'fname',
            'errorMsg' => 'You must enter a valid first name.',
            'error' => '', 'required' => true, 'value' => ''
        ],
        'lname' => [
            'type' => 'text', 'regex' => 'name',
            'label' => 'Last Name', 'name' => 'lname', 'id' => 'lname',
            'errorMsg' => 'You must enter a valid last name.',
            'error' => '', 'required' => true, 'value' => ''
        ],
        'email' => [
            'type' => 'text', 'regex' => 'email',
            'label' => 'Email', 'name' => 'email', 'id' => 'email',
            'errorMsg' => 'You must enter a valid email address.',
            'error' => '', 'required' => true, 'value' => ''
        ],
        'password' => [
            'type' => 'text', 'regex' => 'password',
            'label' => 'Password', 'name' => 'password', 'id' => 'password',
            'errorMsg' => 'You must enter a valid password.',
            'error' => '', 'required' => true, 'value' => ''
        ],
        'status' => [
            'type' => 'select',
            'label' => 'Status', 'name' => 'status', 'id' => 'status',
            'errorMsg' => 'You must select a status.',
            'error' => '', 'required' => true, 'selected' => '',
            'options' => [
                '0'     => 'Please Select a Status',
                'staff' => 'staff',
                'admin' => 'admin'
            ]
        ]
    ];
}

$formConfig = buildAdminFormConfig();
$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    if ($formConfig['masterStatus']['error'] === false) {
        $emailVal = $formConfig['email']['value'];

        // dupe email check
        $pdo = new PdoMethods();
        $checkSql = "SELECT id FROM admins WHERE email = :email";
        $checkBindings = [[':email', $emailVal, 'str']];
        $existing = $pdo->selectBinded($checkSql, $checkBindings);

        if ($existing === 'error') {
            $acknowledgment = '<p class="text-danger">There was an error adding the record</p>';
        } elseif (!empty($existing)) {
            $acknowledgment = '<p class="text-danger">An admin with that email already exists</p>';
            // email error
            $formConfig['email']['error'] = 'This email is already in use.';
        } else {
            // hash pass
            $hashedPw = password_hash($formConfig['password']['value'], PASSWORD_DEFAULT);
            $fullName = $formConfig['fname']['value'] . ' ' . $formConfig['lname']['value'];
            $statusVal = $formConfig['status']['selected'];

            $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";
            $bindings = [
                [':name',     $fullName, 'str'],
                [':email',    $emailVal, 'str'],
                [':password', $hashedPw, 'str'],
                [':status',   $statusVal,'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'noerror') {
                $acknowledgment = '<p class="text-success">Admin Information Added</p>';
                $formConfig = buildAdminFormConfig();
            } else {
                $acknowledgment = '<p class="text-danger">There was an error adding the record</p>';
            }
        }
    }
}
?>

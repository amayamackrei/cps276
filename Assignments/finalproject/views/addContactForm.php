<?php
function init() {
    require_once 'controllers/addContactProc.php';
    $data = processContactForm();
    $formConfig     = $data['formConfig'];
    $sf             = $data['stickyForm'];
    $acknowledgment = $data['acknowledgment'];

    ob_start();
    ?>
    <h1>Add Contact</h1>
    <?php echo $acknowledgment; ?>
    <form method="post" action="index.php?page=addContact">
        <div class="row">
            <?php echo $sf->renderInput($formConfig['fname'], 'col-md-6 mb-3'); ?>
            <?php echo $sf->renderInput($formConfig['lname'], 'col-md-6 mb-3'); ?>
        </div>
        <div class="row">
            <?php echo $sf->renderInput($formConfig['address'], 'col-md-12 mb-3'); ?>
        </div>
        <div class="row">
            <?php echo $sf->renderInput($formConfig['city'],   'col-md-4 mb-3'); ?>
            <?php echo $sf->renderSelect($formConfig['state'], 'col-md-4 mb-3'); ?>
            <?php echo $sf->renderInput($formConfig['zip'],    'col-md-4 mb-3'); ?>
        </div>
        <div class="row">
            <?php echo $sf->renderInput($formConfig['phone'], 'col-md-4 mb-3'); ?>
            <?php echo $sf->renderInput($formConfig['email'], 'col-md-4 mb-3'); ?>
            <?php echo $sf->renderInput($formConfig['dob'],   'col-md-4 mb-3'); ?>
        </div>
        <div class="row">
            <?php echo $sf->renderRadio($formConfig['age'], 'mb-3', 'horizontal'); ?>
        </div>
        <div class="row">
            <?php echo $sf->renderCheckboxGroup($formConfig['contacts'], 'mb-3', 'horizontal'); ?>
        </div>
        <button type="submit" class="btn btn-primary">Add Contact</button>
    </form>
    <?php
    return ob_get_clean();
}
?>
<?php


function init() {
    require_once 'controllers/addAdminProc.php';
    global $formConfig, $stickyForm, $acknowledgment;

    ob_start();
    ?>
    <h1>Add Admin</h1>
    <?php echo $acknowledgment; ?>
    <form method="post" action="index.php?page=addAdmin">
        <div class="row">
            <?php echo $stickyForm->renderInput($formConfig['fname'], 'col-md-6 mb-3'); ?>
            <?php echo $stickyForm->renderInput($formConfig['lname'], 'col-md-6 mb-3'); ?>
        </div>
        <div class="row">
            <?php echo $stickyForm->renderInput($formConfig['email'],     'col-md-4 mb-3'); ?>
            <?php echo $stickyForm->renderInput($formConfig['password'],  'col-md-4 mb-3'); ?>
            <?php echo $stickyForm->renderSelect($formConfig['status'],   'col-md-4 mb-3'); ?>
        </div>
        <button type="submit" class="btn btn-primary">Add Admin</button>
    </form>
    <?php
    return ob_get_clean();
}
?>

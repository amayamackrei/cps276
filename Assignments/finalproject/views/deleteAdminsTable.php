<?php

function init() {
    require_once 'controllers/deleteAdminProc.php';
    global $msg, $records;

    ob_start();


    <h1>Delete Admin(s)</h1>
    <?php echo $msg; ?>
    <?php if (empty($records)): ?>
        <p>There are no records to display</p>
    <?php else: ?>
        <form method="post" action="index.php?page=deleteAdmins">
            <button type="submit" name="delete" value="1" class="btn btn-danger mb-3">Delete</button>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                        <?php
                            $nameParts = explode(' ', $row['name'], 2);
                            $firstName = $nameParts[0] ?? '';
                            $lastName  = $nameParts[1] ?? '';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($firstName); ?></td>
                            <td><?php echo htmlspecialchars($lastName); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['password']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <input type="checkbox" name="chkbx[]" value="<?php echo (int)$row['id']; ?>">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    <?php endif;
    return ob_get_clean();
}
?>

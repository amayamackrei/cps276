<?php
function init() {
    require_once 'controllers/deleteContactProc.php';
    $data    = processDeleteContacts();
    $msg     = $data['msg'];
    $records = $data['records'];

    ob_start();
    ?>
    <h1>Delete Contact(s)</h1>
    <?php echo $msg; ?>
    <?php if (empty($records)): ?>
        <p>There are no records to display</p>
    <?php else: ?>
        <form method="post" action="index.php?page=deleteContacts">
            <button type="submit" name="delete" value="1" class="btn btn-danger mb-3">Delete</button>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th><th>Last Name</th><th>Address</th><th>City</th>
                        <th>State</th><th>Phone</th><th>Email</th><th>DOB</th>
                        <th>Contact</th><th>Age</th><th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><?php echo htmlspecialchars($row['state']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                            <td><?php echo htmlspecialchars($row['contacts']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><input type="checkbox" name="chkbx[]" value="<?php echo (int)$row['id']; ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    <?php endif;
    return ob_get_clean();
}
?>
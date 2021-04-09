<table class="table table-bordered table-hover">    <thead>    <tr class="bg-primary">        <th scope="col">Id</th>        <th scope="col">Image</th>        <th scope="col">User Name</th>        <th scope="col">First Name</th>        <th scope="col">Last Name</th>        <th scope="col">Email</th>        <th scope="col">Role</th>        <th scope="col" class="text-center">Action</th>    </tr>    </thead>    <tbody>    <?php    $query = "SELECT * FROM users";    $select_users = mysqli_query($connection, $query);    foreach ($select_users as $select_user) { ?>        <tr>            <th class="text-center" scope="col"><?php echo $select_user['user_id']; ?></th>            <td class="text-center"><img width="75px" src="../users_image/<?php echo $select_user['user_image']; ?>" alt=""></td>            <td><?php echo $select_user['username']; ?></td>            <td><?php echo $select_user['user_firstname']; ?></td>            <td><?php echo $select_user['user_lastname']; ?></td>            <td><?php echo $select_user['user_email']; ?></td>            <td><?php echo $select_user['user_role']; ?></td>            <!--ACTION FUNCTION-->            <td class=" text-center" width="15%">                <!-- USER ROLES CHANGE FUNCTION -->                <?php                if (isset($_GET['change_to_admin'])) {                    $change_admin_id = $_GET['change_to_admin'];                    $query = mysqli_query($connection, "UPDATE users SET user_role = 'admin' WHERE user_id = $change_admin_id");                    header("Location: users.php");                }                ?>                <a class="btn btn-success btn-sm" href="users.php?change_to_admin=<?php echo $select_user['user_id']; ?>">ADMIN</a>                <?php                if (isset($_GET['change_to_subscriber'])) {                    $change_to_subscriber = $_GET['change_to_subscriber'];                    $query = mysqli_query($connection, "UPDATE users SET user_role = 'subscriber' WHERE user_id = $change_to_subscriber");                    header("Location: users.php");                }                ?>                <a class="btn btn-warning btn-sm" href="users.php?change_to_subscriber=<?php echo $select_user['user_id']; ?>">SUBSCRIBER</a>                <!-- USER EDIT -->                <a class="btn btn-primary btn-sm" href="users.php?source=edit_user&u_id=<?php echo $select_user['user_id']; ?>">Edit</a>                <!-- USER DELETE -->                <?php                if (isset($_GET['delete'])) {                    if (isset($_POST[$_SESSION['user_role']])){                        if ($_SESSION['user_role'] == 'admin') {                            $delete_user = mysqli_real_escape_string($connection, $_GET['delete']);                            $query = mysqli_query($connection, "DELETE FROM users WHERE user_id = $delete_user");                            header("Location: users.php");                        }                    }                }                ?>                <a class="btn btn-danger btn-sm" href="users.php?delete=<?php echo $select_user['user_id']; ?>">Delete</a>            </td>        </tr>    <?php } ?>    </tbody></table>
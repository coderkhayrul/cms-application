<?php//HEADERinclude "includes/admin_header.php"; ?><?php    if (isset($_SESSION['username'])){        $username = $_SESSION['username'];        $query = "SELECT * FROM users WHERE username = '{$username}'";        $set_user_profile = mysqli_query($connection,$query);        confirmQuery($set_user_profile);    }    //USER UPDATE FUNCTION    if (isset($_POST['profile_user'])) {        $user_id = $_POST['user_id'];        $username = $_POST['username'];        $user_password = $_POST['user_password'];        $user_firstname = $_POST['user_firstname'];        $user_lastname = $_POST['user_lastname'];        $user_role = $_POST['user_role'];        $user_email = $_POST['user_email'];        $user_image = $_FILES['image']['name'];        $user_image_temp = $_FILES['image']['tmp_name'];        move_uploaded_file($user_image_temp,"../users_image/$user_image");        if (empty($user_image)){            $username = $_SESSION['username'];            $query = "SELECT * FROM users WHERE username = '{$username}' ";            $select_image = mysqli_query($connection, $query);            foreach($select_image as $user_image_data){                $user_image = $user_image_data['user_image'];            }        }        if (!empty($user_password)) {            $query_password = "SELECT user_password FROM users WHERE user_id = $user_id";            $get_user_query = mysqli_query($connection, $query_password);            confirmQuery($get_user_query);            foreach ($get_user_query as $db_user_password) {                $user_password = $db_user_password['user_password'];                if ($db_user_password != $user_password) {                    $hash_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));                }            }            $query = "UPDATE users SET username = '{$username}', user_password = '{$hash_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}',            user_role = '{$user_role}', user_email = '{$user_email}', user_image = '$user_image' WHERE username = '{$username}' ";            $select_user_query = mysqli_query($connection,$query);            header("Location:profile.php");        }    }?><div id="wrapper">    <!-- Navigation -->    <?php include "includes/admin_navigation.php"; ?>    <div id="page-wrapper">        <div class="container-fluid">            <!-- Page Heading -->            <div class="row">                <div class="col-lg-12">                    <h1 class="page-header">                        Welcome To Admin                        <small><?php echo $_SESSION['username']; ?></small>                    </h1>                    <?php foreach($set_user_profile as $user_data){ ?>                    <!--EDIT USER FORM-->                    <form action="" method="post" enctype="multipart/form-data">                        <input type="hidden" name="user_id" value="<?php echo $user_data['user_id'] ?>">                        <div class="form-group col-md-12">                            <label for="username">User Name <span class="text-danger">*</span></label>                            <input class="form-control" name="username" type="text" value="<?php echo $user_data['username'] ?>" required>                        </div>                        <div class="form-group col-md-6">                            <label for="user_password">Password<span class="text-danger">*</span></label>                            <input class="form-control" name="user_password" type="text">                        </div>                        <div class="form-group col-md-6">                            <label for="user_password">Role<span class="text-danger">*</span></label>                            <select class="form-control" name="user_role" id="user_role">                                <option value="<?php echo $user_data['user_role'] ?>"><?php echo $user_data['user_role'] ?></option>                                <?php                                if ($user_data['user_role'] === 'admin') { ?>                                    <option value="subscriber">subscriber</option>                                    <?php                                }else { ?>                                    <option value="admin">admin</option>                                <?php } ?>                            </select>                        </div>                        <div class="form-group col-md-6">                            <label for="user_firstname">First Name <span class="text-danger">*</span></label>                            <input class="form-control" name="user_firstname" type="text" value="<?php echo $user_data['user_firstname'] ?>" required>                        </div>                        <div class="form-group col-md-6">                            <label for="user_lastname">Last Name <span class="text-danger">*</span></label>                            <input class="form-control" name="user_lastname" type="text" value="<?php echo $user_data['user_lastname'] ?>" required>                        </div>                        <div class="form-group col-md-12">                            <img width="50px" src="../users_image/<?php echo $user_data['user_image']; ?>" alt=""><br>                            <label for="">User Image <span class="text-danger">*</span></label>                            <input name="image" type="file" class="form-control" id="customFile">                            <label class="custom-file-label" for="customFile">Choose file</label>                        </div>                        <div class="form-group col-md-12">                            <label for="user_email">Email <span class="text-danger">*</span></label>                            <input class="form-control" name="user_email" type="email" value="<?php echo $user_data['user_email'] ?>" required>                        </div>                        <div class="form-group col-md-12">                            <button class="btn btn-primary" type="submit" name="profile_user"><i class="fas fa-user"></i> Update Profile</button>                        </div>                    </form>                    <?php } ?>                </div>            </div>            <!-- /.row -->        </div>        <!-- /.container-fluid -->    </div>    <!-- /#page-wrapper --></div><!-- /#wrapper -->
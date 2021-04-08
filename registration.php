<!--Database Connection-->
<?php  include "includes/db.php"; ?>
<!--Header-->
<?php  include "includes/header.php"; ?>
<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <?php
                    if (isset($_POST['submit'])){
                       $username        = $_POST['username'];
                       $password   = $_POST['user_password'];
                       $email      = $_POST['user_email'];

                        $username       = mysqli_real_escape_string($connection, $username);
                        $password  = mysqli_real_escape_string($connection, $password);
                        $email     = mysqli_real_escape_string($connection, $email);
                        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                        if (!empty($username) && !empty($password) && !empty($email)){
                            $query = "INSERT INTO users (username, user_email, user_password, user_role)";
                            $query .= "VALUES('{$username}','{$email}', '{$password}', 'subscriber')";
                            $register_user_query = mysqli_query($connection, $query);
                            if (!$register_user_query){
                                die("QUERY FAILED" . mysqli_error($connection). ' ' . mysqli_error($connection));
                            }
                            $message = "Your Registation has been Submitted";
                        }else{
                            $message = "Fields cannot be empty!";
                        }
                    }
                    ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h4 class="text-center text-primary">
                            <?php
                            if (isset($message)){
                                echo $message;
                            }
                            ?>
                        </h4>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
    <hr>



<?php include "includes/footer.php";?>

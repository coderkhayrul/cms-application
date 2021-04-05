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
                       $user_password   = $_POST['user_password'];
                       $user_email      = $_POST['user_email'];

                        $username       = mysqli_real_escape_string($connection, $username);
                        $user_password  = mysqli_real_escape_string($connection, $user_password);
                        $user_email     = mysqli_real_escape_string($connection, $user_email);

                        $query = "SELECT randSalt FROM users";
                        $select_randsalt_query = mysqli_query($connection, $query);

                        if (!$select_randsalt_query){
                            die("QUERY FAILED". mysqli_error($connection));
                        }
                    }

                    ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
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

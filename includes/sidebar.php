<?php include "includes/db.php"; ?><!-- Blog Sidebar Widgets Column --><div class="col-md-4">    <!-- Blog Search Well -->    <div class="well">        <h4>Blog Search</h4>        <!-- Search Form -->        <form action="search.php" method="post">            <div class="input-group">                <input name="search" type="text" class="form-control">                <span class="input-group-btn">                    <button name="submit" class="btn btn-default" type="submit">                        <span class="glyphicon glyphicon-search"></span>                    </button>                </span>            </div>        </form>    </div>    <!-- LOGIN -->    <div class="well">        <h4>Login</h4>        <!-- Login Form -->        <form action="includes/login.php" method="post">            <div class="form-group">                <label for="username">User Name</label>                <input name="username" type="text" class="form-control" placeholder="Enter username">            </div>            <div class="form-group">                <label for="username">User Password</label>                <input name="user_password" type="password" class="form-control" placeholder="Enter Password">            </div>            <div class="form-group">                <button class="btn btn-primary" name="login" type="submit">Login</button>            </div>        </form>    </div>    <!-- Blog Categories Well -->        <div class="well">            <h4>Top Blog Categories</h4>            <div class="row">                <?php                $query = "SELECT * FROM categories LIMIT 6";                $select_categories = mysqli_query($connection, $query);                ?>                <div class="col-lg-12">                    <ul class="list-unstyled">                        <?php  foreach ($select_categories as $category_data){ ?>                        <li>                            <a href="category.php?category=<?php echo $category_data['cat_id'] ?>"><?php echo $category_data['cat_title']?></a>                        </li>                        <?php } ?>                    </ul>                </div>            </div>            <!-- /.row -->        </div>    <!-- Side Widget Well -->   <?php include "widget.php"; ?></div>
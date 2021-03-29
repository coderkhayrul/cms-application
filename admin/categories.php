<?php include "includes/admin_header.php"; ?><div id="wrapper">    <!-- Navigation -->    <?php include "includes/admin_navigation.php"; ?>    <div id="page-wrapper">        <div class="container-fluid">            <!-- Page Heading -->            <div class="row">                <div class="col-lg-12">                    <h1 class="page-header">                        Welcome To Admin                        <small>Author</small>                    </h1>                </div>                <div class="col-xs-12 col-md-4 col-lg-6">                    <?php                    if (isset($_POST['submit'])){                        $cat_title = $_POST['cat_title'];                        if ($cat_title === "" || empty($_POST['cat_title'])){                            echo "<span style='color: red'>This Field Should Not be Empty</span>";                        }else{                            $query = "INSERT INTO categories(cat_title)VALUES ('$cat_title')";                            $create_category_query = mysqli_query($connection,$query);                            if (!$create_category_query){                                die('QUERY FAILED'.mysqli_error($connection));                            }                        }                    }                    ?>                    <form method="post" action="">                        <div class="form-group">                            <label for="title">Add Categories</label>                            <input class="form-control" type="text" name="cat_title">                        </div>                        <div class="form-group">                            <button class="btn btn-primary" type="submit" name="submit">Add Category</button>                        </div>                    </form>                </div>                <div class="col-xs-12 col-md-8 col-lg-6">                    <table class="table table-bordered table-hover">                        <thead>                        <tr>                            <th scope="col">Id</th>                            <th scope="col">Category Title</th>                            <th scope="col">Action</th>                        </tr>                        </thead>                        <tbody>                        <?php //FIND ALL CATEGORIES                        $query = "SELECT * FROM categories";                        $select_categories = mysqli_query($connection, $query);                        foreach ($select_categories as $category){                        ?>                            <tr>                                <th class="text-center" width="8%" scope="row"><?php echo $category['cat_id']; ?></th>                                <td width="60%"><?php echo $category['cat_title']; ?></td>                                <td class="text-center" width="25%">                                    <a class="btn btn-success btn-sm" href="">View</a>                                    <a class="btn btn-primary btn-sm" href="">Edit</a>                                    <a class="btn btn-danger btn-sm" href="categories.php?delete=<?php echo $category['cat_id']; ?>">Delete</a>                                </td>                            </tr>                        <?php } ?>                        <!-- DELETE CATEGORIES DATA -->                        <?php                        if (isset($_GET['delete'])){                            $delete_cat_id = $_GET['delete'];                            $query = mysqli_query($connection, "DELETE FROM categories WHERE cat_id = $delete_cat_id");                            header("Location: categories.php");                        }                        ?>                        <tbody>                    </table>                </div>            </div>            <!-- /.row -->        </div>        <!-- /.container-fluid -->    </div>    <!-- /#page-wrapper --></div><!-- /#wrapper --><!-- Footer--><?php include "includes/admin_footer.php"; ?>
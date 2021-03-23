<?php include "includes/db.php"; ?>

<!--Header  Path-->
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php


                if (isset($_POST['search'])) {

                    $search = $_POST['search'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                    $search_query = mysqli_query($connection, $query);
                    if (!$search_query) {
                        echo die("QUERY ERROR" . mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($search_query);

                    if ($count === 0) {
                        echo "NOT FOUND";
                    } else {

                        foreach ($search_query as $post_data){ ?>
                            <h2>
                                <a href="#"><?php echo $post_data['post_title']?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_data['post_author']?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_data['post_date']?></p>
                            <hr>
                            <img class="img-responsive" src="<?php echo $post_data['post_image']?>" alt="course image show">
                            <hr>
                            <p><?php echo $post_data['post_content']?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        <?php }
                    }
                }?>
                <!-- First Blog Post End -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>


        </div>
        <!-- /.row -->
        <hr>

<!--Footer-->
<?php include "includes/footer.php"; ?>


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
            if ($_GET['category']){
                $post_category_id = $_GET['category'];
            }
            $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
            $posts_data = mysqli_query($connection,$query);
            foreach ($posts_data as $post_data){ ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_data['post_id'] ?>"><?php echo $post_data['post_title']?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_data['post_author']?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_data['post_date']?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_data['post_image']?>" alt="course image show">
                <hr>
                <p><?php echo $post_data['post_content']?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php } ?>
            <!-- First Blog Post End -->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>


    </div>
    <!-- /.row -->
    <hr>

    <!--Footer-->
    <?php include "includes/footer.php"; ?>

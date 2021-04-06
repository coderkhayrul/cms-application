
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
            if (isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }
            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $posts_data = mysqli_query($connection,$query);
            foreach ($posts_data as $post_data){ ?>
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_data['post_id'] ?>"><?php echo $post_data['post_title']?></a>
                    </h2>
                    <p class="lead">
                        All Post by <?php echo $post_data['post_author']?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_data['post_date']?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_data['post_id'] ?>">
                        <img class="img-responsive" src="images/<?php echo $post_data['post_image']?>" alt="course image show">
                    </a>
                    <hr>
                    <p><?php echo substr($post_data['post_content'], 0,100) ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_data['post_id'] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
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

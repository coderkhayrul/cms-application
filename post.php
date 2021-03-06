<?php include "includes/db.php"; ?>
<!--Header  Path-->
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <!--Single Blog Post Content Column -->
        <?php
        if (isset($_GET['p_id'])){
            $the_post_id =$_GET['p_id'];
            $view_count = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
            $sent_query = mysqli_query($connection, $view_count);
            if (!$sent_query){
                die("QUERY FAILED");
            }

            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $single_post_show = mysqli_query($connection, $query);
            foreach($single_post_show as $single_post){
            ?>
            <div class="col-lg-8">

                <!-- Blog Post -->
                <!-- Title -->
                <h1><?php echo $single_post['post_title']; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $single_post['post_author']; ?></a>
                </p>
                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $single_post['post_date']; ?></p>
                <hr>
                <!-- Preview Image -->
                <img class="img-responsive" src="../images/<?php echo $single_post['post_image']; ?>" alt="">
                <hr>
                <!-- Post Content -->
                <p class="lead"><?php echo $single_post['post_content']; ?></p>
                <hr>
            <?php }
        }else{
            header('Location:index.php');
            } ?>
            <!-- Comments Form -->
            <?php
            if (isset($_POST['create_comment'])){
                $comment_post_id =$_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";
                    $create_comment_query = mysqli_query($connection, $query);
                    if (!$create_comment_query){
                        die("QUERY FAILED".mysqli_error($connection));
                    }
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $comment_post_id";
                    $update_comment_count = mysqli_query($connection, $query);
                }else{
                    echo "<script>alert('Fields cannot be empty')</script>";
                }

            }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input class="form-control" type="text" name="comment_author" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="comment_email" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content" placeholder="Enter Message"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <hr>
            <!-- Posted Comments -->
            <!-- Comment -->
            <?php
            $comment_post_id =$_GET['p_id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);
            if (!$select_comment_query){
                die("QUERY FAILED". mysqli_error($connection));
            }
            foreach ($select_comment_query as $comment_query){
            ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" width="64px" height="64px" src="avatardefault.png" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_query['comment_author'];?>
                        <small><?php echo $comment_query['comment_date'];?></small>
                    </h4>
                    <?php echo $comment_query['comment_content'];?>
                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>


    </div>
    <!-- /.row -->
    <hr>

    <!--Footer-->
<?php include "includes/footer.php"; ?>
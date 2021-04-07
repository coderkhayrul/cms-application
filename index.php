
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
                // PAGINATION FUNCTION START
                $per_page = 8;
                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = "";
                }
                if ($page === "" || $page === 1){
                    $page_1=0;
                }else{
                    $page_1 =($page * $per_page) - $per_page;
                }
                $query = "SELECT * FROM posts";
                $find_count = mysqli_query($connection,$query);
                $count = mysqli_num_rows($find_count);
                $count = ceil($count /$per_page);
                // PAGINATION FUNCTION END

                // GET ALL POST WHERE PUBLISHED
                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                $posts_data = mysqli_query($connection,$query);
                    foreach ($posts_data as $post_data){
                        if ($post_data['post_status'] === 'published'){
                            ?>
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_data['post_id'] ?>"><?php echo $post_data['post_title']?></a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_data['post_author'] ?>&p_id=<?php echo $post_data['post_id']; ?>"><?php echo $post_data['post_author']?></a>
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
                        <?php }
                    } ?>
                <!-- Pagination-->
                <ul class="pagination">
                    <?php
                        for ($i = 1; $i <=$count; $i++){
                            if ($i == $page){?>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                                </li>
                            <?php }else{ ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php } ?>
                    <?php } ?>
                </ul>
                <!-- First Blog Post End -->
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->
        <hr>
<!--Footer-->
<?php include "includes/footer.php"; ?>

<?phpif (isset($_POST['create_post'])){    $post_title = $_POST['post_title'];    $post_author = $_POST['post_author'];    $post_category_id = $_POST['post_category_id'];    $post_status = $_POST['post_status'];    $post_image = $_FILES['image']['name'];    $post_image_temp = $_FILES['image']['tmp_name'];    $post_tags = $_POST['post_tags'];    $post_content = $_POST['post_content'];    $post_date = date('d-m-y');    $post_comment_count = 6;    move_uploaded_file($post_image_temp,"../images/".$post_image);    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status)";    $query .="VALUES ('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";    $create_posts_query =mysqli_query($connection, $query);    //CONFIRM_QUERY    confirmQuery($create_posts_query);}?><?php    if (isset($_GET['p_id'])){        $post_id = $_GET['p_id'];        $query = "SELECT * FROM posts WHERE post_id = $post_id";        $select_posts_by_id = mysqli_query($connection, $query);    }    foreach ($select_posts_by_id as $post_data){    ?><form action="" method="post" enctype="multipart/form-data">    <div class="form-group col-md-12">        <label for="post_title">Post Title <span class="text-danger">*</span></label>        <input class="form-control" name="post_title" type="text" value="<?php echo $post_data['post_title']; ?>">    </div>    <div class="form-group col-md-6">        <label for="post_category_id">Post Category Id <span class="text-danger">*</span></label>        <input class="form-control" name="post_category_id" type="number" value="<?php echo $post_data['post_category_id']; ?>">    </div>    <div class="form-group col-md-6">        <label for="post_author">Post Author <span class="text-danger">*</span></label>        <input class="form-control" name="post_author" type="text" value="<?php echo $post_data['post_author']; ?>" >    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Status <span class="text-danger">*</span></label>        <input class="form-control" name="post_status" type="text" value="<?php echo $post_data['post_status']; ?>">    </div>    <div class="form-group col-md-12">        <label for="">Post Image <span class="text-danger">*</span></label>        <input name="image" type="file" class="form-control" id="customFile">        <label class="custom-file-label" for="customFile">Choose file</label>    </div>    <div class="form-group col-md-12">        <label for="post_tags">Post Tags <span class="text-danger">*</span></label>        <input class="form-control" name="post_tags" type="text" value="<?php echo $post_data['post_tags']; ?>">    </div>    <div class="form-group col-md-12">        <label for="post_content">Post Content <span class="text-danger">*</span></label>        <textarea class="form-control" placeholder="Leave a comment here" name="post_content" style="height: 150px" ><?php echo $post_data['post_content']; ?></textarea>    </div>    <div class="form-group col-md-12">        <button class="btn btn-primary" type="submit" name="create_post" required>Update Post</button>    </div></form><?php } ?>
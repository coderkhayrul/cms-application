<?phpif (isset($_POST['create_post'])){    $post_title = $_POST['post_title'];    $post_author = $_POST['post_author'];    $post_category_id = $_POST['post_category_id'];    $post_status = $_POST['post_status'];    $post_image = $_FILES['image']['name'];    $post_image_temp = $_FILES['image']['tmp_name'];    $post_tags = $_POST['post_tags'];    $post_content = $_POST['post_content'];    $post_date = date('d-m-y');    $post_comment_count = 6;    move_uploaded_file($post_image_temp,"../images/".$post_image);    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status)";    $query .="VALUES ('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";    $create_posts_query =mysqli_query($connection, $query);    //CONFIRM_QUERY    confirmQuery($create_posts_query);}?><form action="" method="post" enctype="multipart/form-data">    <div class="form-group col-md-12">        <label for="post_title">Post Title <span class="text-danger">*</span></label>        <input class="form-control" name="post_title" type="text" >    </div>    <div class="form-group col-md-6">        <label for="post_category_id">Post Category Id <span class="text-danger">*</span></label>        <input class="form-control" name="post_category_id" type="number" >    </div>    <div class="form-group col-md-6">        <label for="post_author">Post Author <span class="text-danger">*</span></label>        <input class="form-control" name="post_author" type="text" >    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Status <span class="text-danger">*</span></label>        <input class="form-control" name="post_status" type="text" >    </div>    <div class="form-group col-md-12">        <label for="">Post Image <span class="text-danger">*</span></label>        <input name="image" type="file" class="form-control" id="customFile">        <label class="custom-file-label" for="customFile">Choose file</label>    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Tags <span class="text-danger">*</span></label>        <input class="form-control" name="post_tags" type="text" >    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Content <span class="text-danger">*</span></label>        <textarea class="form-control" placeholder="Leave a comment here" name="post_content" style="height: 150px" ></textarea>    </div>    <div class="form-group col-md-12">       <button class="btn btn-primary" type="submit" name="create_post" required>Publish Post</button>    </div></form>
<?phpif (isset($_GET['p_id'])){    $post_id = $_GET['p_id'];}$query = "SELECT * FROM posts WHERE post_id = $post_id";$get_post_data = mysqli_query($connection,$query);confirmQuery($get_post_data);foreach($get_post_data as $post_data){?>    <form action="" method="post" enctype="multipart/form-data">        <input class="form-control" name="post_id" type="hidden" value="<?php echo $post_data['post_id']; ?>">    <div class="form-group col-md-12">        <label for="post_title">Post Title <span class="text-danger">*</span></label>        <input class="form-control" name="post_title" type="text" value="<?php echo $post_data['post_title']; ?>">    </div>    <div class="form-group col-md-6">        <label for="post_category_id">Post Category Id <span class="text-danger">*</span></label>        <select class="form-control" name="post_category" id="post_category">            <?php            $query = "SELECT * FROM  categories";            $select_categories = mysqli_query($connection, $query);            confirmQuery($select_categories);            foreach ($select_categories as $select_category){ ?>                <option name="post_category" value="<?php echo $select_category['cat_id']; ?>"><?php echo $select_category['cat_title']; ?></option>            <?php } ?>        </select>    </div>    <div class="form-group col-md-6">        <label for="post_author">Post Author <span class="text-danger">*</span></label>        <input class="form-control" name="post_author" type="text" value="<?php echo $post_data['post_author']; ?>">    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Status <span class="text-danger">*</span></label>        <input class="form-control" name="post_status" type="text" value="<?php echo $post_data['post_status']; ?>">    </div>    <div class="form-group col-md-12">        <img width="150px" src="../images/<?php echo $post_data['post_image']; ?>" alt=""><br>        <label for="">Post Image <span class="text-danger">*</span></label>        <input name="image" type="file" class="form-control" id="customFile">        <label class="custom-file-label" for="customFile">Choose file</label>    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Tags <span class="text-danger">*</span></label>        <input class="form-control" name="post_tags" type="text" value="<?php echo $post_data['post_tags']; ?>">    </div>    <div class="form-group col-md-12">        <label for="post_status">Post Content <span class="text-danger">*</span></label>        <textarea class="form-control" placeholder="Leave a comment here" name="post_content" style="height: 150px" ><?php echo $post_data['post_content']; ?></textarea>    </div>    <div class="form-group col-md-12">        <button class="btn btn-primary" type="submit" name="update_post">Update Post</button>    </div></form><?php }//POST UPDATE FUNCTIONif (isset($_POST['update_post'])) {    $post_title = $_POST['post_title'];    $post_author = $_POST['post_author'];    $post_categories_id = $_POST['post_category'];    $post_status = $_POST['post_status'];    $post_content = $_POST['post_content'];    $post_tags = $_POST['post_tags'];    $post_image = $_FILES['image']['name'];    $post_image_temp = $_FILES['image']['tmp_name'];    move_uploaded_file($post_image_temp,"../images/$post_image");    if (empty($post_image)){        $query = "SELECT * FROM posts WHERE post_id = $post_id ";        $select_image = mysqli_query($connection, $query);        foreach($select_image as $post_image){            $post_image = $post_image['post_image'];        }    }    $query = "UPDATE posts SET post_author ='{$post_author}',";    $query .= " post_title ='{$post_title}', ";    $query .= " post_category_id = '{$post_categories_id}', ";    $query .= "post_status ='$post_status', post_content ='{$post_content}', post_tags ='{$post_tags}', ";    $query .= "post_image ='$post_image', post_date =now()  WHERE post_id = $post_id";    $update_post_query = mysqli_query($connection, $query);    header("Location:posts.php");    confirmQuery($update_post_query);}?>
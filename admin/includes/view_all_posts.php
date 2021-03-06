

<?php
if (isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $post_value_Id){
        $bulk_option = escape($_POST['bulk_option']);
        switch ($bulk_option){
            // POST PUBLISHED
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$post_value_Id}";
                $update_to_published_status = mysqli_query($connection,$query);
                confirmQuery($update_to_published_status);
                break;
            // POST DRAFT
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$post_value_Id}";
                $update_to_draft_status = mysqli_query($connection,$query);
                confirmQuery($update_to_draft_status);
                break;
            // POST DELETE
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$post_value_Id}";
                $update_to_delete_status = mysqli_query($connection,$query);
                confirmQuery($update_to_delete_status);
                break;
            // POST CLONE
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$post_value_Id}";
                $select_post_query = mysqli_query($connection,$query);
                confirmQuery($select_post_query);
                foreach ($select_post_query as $clone_post){
                    $post_title = $clone_post['post_title'];
                    $post_category_id  = $clone_post['post_category_id'];
                    $post_date = $clone_post['post_date'];
                    $post_author = $clone_post['post_author'];
                    $post_status = $clone_post['post_status'];
                    $post_tags = $clone_post['post_tags'];
                    $post_content = $clone_post['post_content'];
                    $post_image = $clone_post['post_image'];
                }
                $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_status, post_tags, post_content, post_image)";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_status}', '{$post_tags}', '{$post_content}', '{$post_image}')";
                $copy_posts = mysqli_query($connection,$query);

                if (!$copy_posts){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;
        }
    }
}
?>
<!-- GET ALL POST FORM -->
<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div>
            <div style="padding:0px" class="col-xs-4" id="bulkOptionContainer">
                <select name="bulk_option" class="form-control">
                    <option value="">Select Option</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
            </div>
            <div class="col-xs-4">
                <button type="submit" name="submit" class="btn btn-success">Apply</button>
                <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>
        </div>

        <thead>
        <tr class="bg-primary">
            <th scope="col" ><input onclick="toggle(this);" type="checkbox"></th>
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th scope="col">Author</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Status</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Views</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- GET ALL POST -->
        <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC ";
        $select_posts = mysqli_query($connection, $query);
        foreach ($select_posts as $post) { ?>
            <tr>
                <!-- POST ID -->
                <th scope="col"><input name="checkBoxArray[]" type="checkbox" class="checkBoxes" value="<?php echo $post['post_id']; ?>"></th>
                <th scope="col"><?php echo $post['post_id']; ?></th>
                <!-- POST IMAGE -->
                <td class="text-center"><img width="75px" src="../images/<?php echo $post['post_image']; ?>" alt=""></td>
                <!-- POST AUTHOR -->
                <td><?php echo $post['post_author']; ?></td>
                <!-- POST TITLE -->
                <td><?php echo $post['post_title']; ?></td>
                <!-- POST CATEGORY ID -->
                <?php
                    $post_categories_id = escape($post['post_category_id']);
                    $query = "SELECT * FROM categories WHERE cat_id = $post_categories_id";
                    $select_categories_id = mysqli_query($connection, $query);
                    foreach ($select_categories_id as $post_category_id){ ?>
                    <td><?php echo $post_category_id['cat_title']; ?></td>
                <?php } ?>
                <!-- POST TAGS -->
                <td class=" text-center"><?php echo $post['post_tags']; ?></td>
                <!-- POST STATUS -->
                <td class="text-center" width="5%"><?php echo $post['post_status']; ?></td>
                <!-- POST COMMENT COUNT -->
                <td width="5%" class="text-center"><?php echo $post['post_comment_count']; ?></td>

                <!-- POST DATE -->
                <td><?php echo $post['post_date']; ?></td>
                <!-- RESET POST VIEWS-->
                <?php
                if (isset($_GET['reset'])) {
                    $reset_post_id = escape($_GET['reset']);
                    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $reset_post_id";
                    $reset_query = mysqli_query($connection, $query);
                    header("Location: posts.php");
                }
                ?>
                <td class=" text-center"><a href="posts.php?reset=<?php echo $post['post_id']; ?>"><?php echo $post['post_views_count']; ?></a></td>
                <!-- VIEW ALL POST ACTION BUTTON -->
                <td class=" text-center" width="15%">
                    <!--VIEW POST -->
                    <a class="btn btn-success btn-sm" href="../post.php?p_id=<?php echo $post['post_id']; ?>">View</a>
                    <!-- POST EDIT -->
                    <a class="btn btn-primary btn-sm" href="posts.php?source=edit_post&p_id=<?php echo $post['post_id']; ?>">Edit</a>
                    <!-- POST DELETE -->
                    <?php
                    if (isset($_GET['delete'])) {
                        $delete_post_id = ($_GET['delete']);
                        $query = mysqli_query($connection, "DELETE FROM posts WHERE post_id = $delete_post_id");
                        header("Location: posts.php");
                    }
                    ?>
                    <a class="btn btn-danger btn-sm" href="posts.php?delete=<?php echo $post['post_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</form>

<!--CheckBox Select Script-->
<script type="text/javascript">
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] !== source)
                checkboxes[i].checked = source.checked;
        }
    }
</script>
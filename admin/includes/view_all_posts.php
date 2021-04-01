<table class="table table-bordered table-hover">
    <thead>
        <tr class="bg-primary">
            <th scope="col">Id</th>
            <th scope="col">Image</th>
            <th scope="col">Author</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Status</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);
        foreach ($select_posts as $post) {
        ?>
            <tr>
                <th scope="col"><?php echo $post['post_id']; ?></th>
                <td class="text-center"><img width="75px" src="../images/<?php echo $post['post_image']; ?>" alt=""></td>
                <td><?php echo $post['post_author']; ?></td>
                <td><?php echo $post['post_title']; ?></td>
                <td><?php echo $post['post_category_id']; ?></td>
                <td><?php echo $post['post_tags']; ?></td>
                <td class="text-center" width="5%"><?php echo $post['post_status']; ?></td>
                <td width="5%"><?php echo $post['post_comment_count']; ?></td>
                <td><?php echo $post['post_date']; ?></td>
                <td class=" text-center" width="15%">
                    <a class="btn btn-success btn-sm" href="">View</a>
                    <a class="btn btn-primary btn-sm" href="posts.php?source=edit_post&p_id=<?php echo $post['post_id']; ?>">Edit</a>
                    <!-- POST DELETE -->
                    <?php
                    if (isset($_GET['delete'])) {
                        $delete_post_id = $_GET['delete'];
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
<?php

use Rizk\Blog\Classes\Session;
?>
<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <?php if (Session::checkSession("errors")) : ?>
                <?php foreach (Session::getSession("errors") as $error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php print_r($error) ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <?php Session::removeSession("errors") ?>
            <?php if (Session::checkSession("success")) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo Session::getSession("success") ?>
                </div>

            <?php endif ?>
            <?php Session::removeSession("success") ?>

            <?php if (Session::checkSession("error")) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo Session::getSession("error") ?>
                </div>

            <?php endif ?>

            <?php Session::removeSession("error") ?>

            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>All posts</h3>
                </div>
                <div>
                    <a href="/Blog MVC/public/insert/insertPage" class="btn btn-sm btn-success">Add new post</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Published At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $post) : ?>     
                    <tr>
                        <td><?php echo $post->title ?></td>
                        <td><?php echo $post->created_at ?></td>
                        <td>
                            <a href="/Blog MVC/public/show/showOne?id=<?php echo $post->_id ?>" class="btn btn-sm btn-primary">Show</a>
                            <a href="/Blog MVC/public/edit/editPage?id=<?php echo $post->_id ?>" class="btn btn-sm btn-secondary">Edit</a>
                            <a href="/Blog MVC/public/delete/deleteHandle?id=<?php echo $post->_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('do you really want to delete post?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
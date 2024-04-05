<?php

use Rizk\Blog\Classes\Session;

require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Edit post</h3>
                </div>
                <div>
                    <a href="/Blog MVC/public/show/showAll" class="text-decoration-none">Back</a>
                </div>
            </div>
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

            <?php foreach ($data as $post) : ?>
                <form method="POST" action="/Blog MVC/public/edit/editHandle?id=<?php echo $post->_id ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post->title ?>">
                    </div>
                    <input type="hidden" name="csrf_token_edit" value="<?php echo Session::getSession("csrf_token_edit") ?>">
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="5"><?php echo $post->body ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        <div class="mb-3">
                        </div>
                        <button style="z-index: 10;" type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
                <img width="300px" src="../../public/uploads/<?php echo $post->image ?>" alt="">

            <?php endforeach ?>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
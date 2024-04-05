<?php

use Rizk\Blog\Classes\Session;

 require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if(Session::checkSession("errors")):?>
                <?php foreach (Session::getSession("errors") as $error) : ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo($error) ?>
                </div>
                <?php endforeach ?>
            <?php endif ?>
            <?php Session::removeSession("errors") ?>

            <?php if (Session::checkSession("error")) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo Session::getSession("error") ?>
                </div>
            <?php endif ?>
            <?php Session::removeSession("error") ?>

            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Add new post</h3>
                </div>
                <div>
                    <a href="/Blog MVC/public/show/showAll" class="text-decoration-none">Back</a>
                </div>
            </div>
            <form method="POST" action="/Blog MVC/public/insert/insertPost" enctype="multipart/form-data">
    
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <input type="hidden" name="csrf_token_insert" value="<?php echo Session::getSession("csrf_token_insert") ?>">

                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">image</label>
                    <input type="file" class="form-control-file" id="image" name="image" >
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
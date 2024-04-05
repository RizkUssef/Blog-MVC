<?php

use Rizk\Blog\Classes\Session;

 require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
        <?php if(Session::checkSession("errors")):?>
                <?php foreach (Session::getSession("errors") as $error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php print_r($error) ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <?php Session::removeSession("errors") ?>
            <?php if(Session::checkSession("success")):?>
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

            <?php foreach ($data as $post) :?>
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
        
                    <h3><?php echo $post->title?></h3>
                </div>
                <div>
                    <a href="/Blog MVC/public/show/showAll" class="text-decoration-none">Back</a>
                </div>
            </div>
            <div>
                <?php echo $post->body?>
            </div>
            <div>
               <img src="../../public/uploads/<?php echo $post->image?>" alt="" srcset="" width="300px">
            </div>
            <?php endforeach?>

        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
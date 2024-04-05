<?php

use Rizk\Blog\Classes\Session;

require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Login</h3>
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
            
            <form method="POST" action="/Blog MVC/public/login/loginHandle">
    
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <input type="hidden" name="csrf_token_login" value="<?php echo Session::getSession("csrf_token_login") ?>">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
<?php require('inc/header.php'); ?>
<?php require('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <?php foreach ($data as $post) :?>
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
        
                    <h3><?php echo $post->title?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <div>
                <?php echo $post->body?>
            </div>
            <div>
               <img src="uploads/1.png" alt="" srcset="" width="300px">
            </div>
            <?php endforeach?>

        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>
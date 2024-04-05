<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php use Rizk\Blog\Classes\Session;?>
                <?php if(Session::checkSession("user_id")){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog MVC/public/logout/logoutHandle">Logout</a>
                    </li>    
                <?php } else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Blog MVC/public/login/loginPage">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
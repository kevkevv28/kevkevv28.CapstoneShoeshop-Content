<!-- Header --><nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
    DLJPS
    <p class="small-text">Footwear Shop</p>
</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutUs.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactUs.php">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    
                    
                    
                    <?php 
                    
                    if(!isset($_SESSION['user_id'])){
                       
                    
                        ?>
                        <a class="nav-icon position-relative text-decoration-none" href="addToCardPage.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
                    </a>

                        <a class="nav-icon position-relative text-decoration-none" href="wishlist.php">
                        <i class="fa fa-fw fa-heart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">0</span>
                    </a>


                        <a class="nav-icon position-relative text-decoration-none" href="loginPage.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark  " style="margin-left: 20px;">Login Here!</span>
                    </a>
                    <?php

                    }else{
                        require_once 'dbh.inc.php';
                        include_once 'includes/login_model.inc.php';

                        $result = get_user_topbar($pdo, $_SESSION['user_id']);
                        $cartcount = get_cart_count($pdo, $_SESSION['user_id']);
                        $wishcount = get_wishlist_count($pdo, $_SESSION['user_id']);

                        ?>
                        <a class="nav-icon position-relative text-decoration-none" href="addToCardPage.php">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php echo $cartcount['cartcount'] ?></span>
                        </a>
                        <a class="nav-icon position-relative text-decoration-none" href="wishlist.php">
                        <i class="fa fa-fw fa-heart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"> <?php echo $wishcount['wishcount'] ?> </span>
                        </a>

                        <div class="nav-item dropdown">
                            <a class="nav-icon position-relative text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-user text-dark mr-3"></i>
                                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" style="margin-left: 50px;"><?php echo 'Hello ' .$result['first_name'] .' '. $result['last_name'] ?> </span>
                            </a>


                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profilePage.php">User Profile</a>
                                <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                   

                    
                    
                   

                </div>
            </div>

        </div>
    </nav><!-- Close Header -->
<?php
    require_once 'includes/config_session.inc.php';
    include('includes/header.php');
    if (isset($_SESSION['already'])) {
        echo "<div id='loginAlert'class='alert alert-warning alert-dismissible fade show' role='alert'>
                {$_SESSION['already']}
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        // Unset the flash message after displaying it
        unset($_SESSION['already']);

        
    }
    

    include('includes/topbar.php');
    require_once 'includes/dbh.inc.php';
    require_once 'includes/products_model.inc.php';
    require_once 'includes/products_contrl.inc.php';

    $brandResults = get_brand($pdo);
    $colorResults = get_color($pdo);
    $categoryResults = get_category($pdo);

    if(isset($_GET["brand"])){
        $idbrand = $_GET['brand'];
        $option = "brand";
        $productResults = get_product($pdo, $idbrand, $option);
    }else if(isset($_GET["color"])){
        $idcolor = $_GET['color'];
        $option = "color";
        $productResults = get_product($pdo, $idcolor, $option);
    }else if(isset($_GET["category"])){
        $idcategory = $_GET['category'];
        $option = "category";
        $productResults = get_product($pdo, $idcategory, $option);
    }else{
        $productResults = get_product($pdo);
    }
    

    
   
   
?>
 
<!-- Start Content -->
<div class="container custom-container py-5 ">
        <div class="row">

            <div class="col-lg-3">
            <a class="textdeco" href="shop.php"><h1 class="h2 pb-4">Shop Now!</h1> </a>
                <h1 class="h2 pb-4"> </h1>
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Shop by Brand
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">

                            <?php foreach ($brandResults as $brand ){?>
                            <li><a class="text-decoration-none" value="<?php $brand['id'] ?> " href="shop.php?brand=<?php echo $brand['id'] ?>"><?php echo $brand['brandName'] ?></a></li>
                            
                            <?php }?>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Shop by Color
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <?php foreach ($colorResults as $color ){?>
                            <li><a class="text-decoration-none" value="<?php $color['id'] ?> " href="shop.php?color=<?php echo $color['id'] ?>"><?php echo $color['color'] ?></a></li>
                            
                            <?php }?>
                        </ul>
                    </li>
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                            Shop by Categories
                            <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul id="collapseTwo" class="collapse list-unstyled pl-3">

                        <?php foreach ($categoryResults as $category ){?>
                            <li><a class="text-decoration-none" value="<?php $category['id'] ?> " href="shop.php?category=<?php echo $category['id'] ?>"><?php echo $category['category'] ?></a></li>
                            
                            <?php }?>


                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    
                </div>

                
                <div class="product-section ">
                    <div class="row">
                                <?php if (empty($productResults)) { ?>
                            <!-- Display message if no products are found -->
                            <div class="col-12 text-center">
                                <h3 class="text-muted">No product available on selected categories.</h3>
                            </div>
                        <?php } else { ?>
                        <?php foreach ($productResults as $product ){?>
                            
                            <div class="col-md-6">
                                <a class="text-decoration-none" href="product_single.php?prodid=<?php echo $product['id'] ?>">
                                <div class="card mb-6 product-wap rounded-0">
                                    <div class="card rounded-0" >
                                        <img class="card-img rounded-0 img-fluid" src="assets/shoesphotos/<?php echo $product['product_img_name']; ?>">

                                    </div>
                                    <div class="card-body">
                                        <h3 class=" text-decoration-none"> <b class="boob"><?php echo $product['product_name']; ?></b> </h3>
                                        <p class="productdescription"><?php echo $product['product_description']; ?></p>
                                        <p class="price">₱ <?php echo $product['price'] ?></p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                        <?php } ?>
                        <?php } ?>
                        </div>
                </div>

            </div>
        </div>






                
                
            </div>

        </div>
    </div>
    <!-- End Content -->



<?php include('includes/footer.php'); ?>
<?php
    require_once 'includes/config_session.inc.php';
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing wishlist";
        header("Location: loginPage.php");

    }
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
    if (isset($_GET['wishlist']) && $_GET['wishlist'] === 'deleted' && isset($_SESSION['wishlist'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '".implode(" ", $_SESSION['wishlist']) ."',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['wishlist']);
    }
    if (isset($_SESSION['wishcart'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '".implode(" ", $_SESSION['wishcart']) ."',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['wishcart']);
    }

    include('includes/topbar.php');
    require_once 'includes/dbh.inc.php';
    include('includes/wishlist_model.inc.php');
    include('includes/wishlistmodal.php');

    $Wishlistresult = get_user_wishlist($pdo, $_SESSION['user_id']);

   

   
?>

<section class="cart_area" id="cartSection">
    <div class="container">
    <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class=" bold " > <i class="fa fa-fw fa-heart border-only-heart mr-1"></i> Wishlist Page <i class="fa fa-fw fa-heart border-only-heart"></i> </h1>
               
            </div>
        </div>
        <br>
    <form action="includes/wishlist.inc.php" method="POST">
        <div class="cart_inner">
            <div class="table-responsive">
                <table id="wishlist_tble" class="table">
                    <thead>
                        <tr>
                            
                            <th></th>
                            <th scope="col">Product</th>
                            <th> Photo</th>
                            <th > Size</th>
                            <th scope="col">Price</th>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            
                        </tr>
                    </thead>

                
                    <tbody>
                        <?php foreach ($Wishlistresult as $wishlist ){ ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="shoeid[]"class="flat-red wishlist-checkbox" value="<?php echo htmlspecialchars($wishlist['product_id']); ?>">
                                <input type="hidden" name="userid" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                                <button type="button" class="delwishbtn btn btn-danger marginleftmore marginbottom " ><i class="fa fa-trash" aria-hidden="true"></i></button> 
                            
                            </td>
                            <td>
                                <div class="media">
                                    
                                    <div class="media-body">
                                        <h5><?php echo $wishlist['product_name'] ?></h5>
                                    </div>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <img src="assets/shoesphotos/<?php echo $wishlist['product_img_name'] ?>" class="lumalake" alt="Product Image" style="max-width: 100px; border-radius: 10px;">
                                </div>
                            </td>

                            <td> <span class="ml-3"> <?php echo $wishlist['size'] ?></span></td>
                            <td>
                                <div class=''>
                                <h5> ₱ <?php echo number_format($wishlist['price'],2) ?></h5>
                                </div>
                            </td>
                            <td style="display:none;"> <?php echo htmlspecialchars($wishlist['userid']); ?></td>
                            <td  style="display:none;"> <?php echo htmlspecialchars($wishlist['product_id']); ?></td>
                            <td style="display:none;"></td>
                            
                        </tr>
                        <?php } ?>
                       
                        
                        
                        
                      
                        
                    </tbody>


                </table>
                <?php if(!empty($Wishlistresult)){?>
                <div class="my-2">
                    <a class="gray_btn" href="wishlist.php"> Update Cart  </a>
                    <button type="submit" class="red_btn ml-2" name="delall"> Delete All Item </button> 
                </div>
                <hr>
                <div class="d-flex justify-content-end my-4">
                    <a class="gray_btn me-2" href="shop.php">Continue Shopping</a>
                    <button type="submit" class="primary-btn addToCartBtn " name="save_multiple" >Add to cart</button>
                    
                    
                </div>
                <hr>
                <?php }else{?>
                    <h2 class="mr-2 " style=" text-align: justify; text-align-last: center;">  <a href="shop.php"> Please click here to Shop </h2>
                   <?php }?>
            </div>
        </div>

    </div>
    </form>
</section>


<?php if (!empty($_SESSION['errors_addtocartwish'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Warning!',
            text: '<?php echo implode(" ", $_SESSION["errors_addtocartwish"]); ?>',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    });
    <?php 
    unset($_SESSION["errors_addtocartwish"])
    ?>
</script>
<?php  endif; ?>


<?php if (!empty($_SESSION['alreadydel'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Warning!',
            text: '<?php echo implode(" ", $_SESSION["alreadydel"]); ?>',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    });
    <?php 
    unset($_SESSION["alreadydel"])
    ?>
</script>
<?php  endif; ?>

<?php include('includes/footer.php'); ?>
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
    if (isset($_SESSION['cart'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '".implode(" ", $_SESSION['cart']) ."',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['cart']);
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
    if (isset($_SESSION['added'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '".implode(" ", $_SESSION['added']) ."',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['added']);
    }

    if (isset($_SESSION['cart_error'])) {
    // Check if $_SESSION['cart_error'] is an array
    $message = is_array($_SESSION['cart_error']) ? implode(" ", $_SESSION['cart_error']) : $_SESSION['cart_error'];
    
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: '" . $message . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";

        // Optionally clear the session variable after showing the message
        unset($_SESSION['cart_error']);
    }

    include('includes/topbar.php');
    require_once 'includes/dbh.inc.php';
    include('includes/cart_model.inc.php');
    include('includes/cartmodal.php');

    $cartlistresult = get_user_cart($pdo, $_SESSION['user_id']);

   
   
   
?>

<section class="cart_area" id="cartSection">
    <div class="container">
    <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class=" bold " ><i class="fa fa-fw fa-shopping-cart border-only-heart mr-1 flip-icon"></i> Shopping Cart Page <i class="fa fa-fw fa-shopping-cart border-only-heart"></i></h1>
               
            </div>
        </div>
        <br>
    <form action="includes/cart.inc.php" method="POST">
        <div class="cart_inner">
            <div class="table-responsive">
                <table id="cart_tble" class="table">
                    <thead>
                        <tr>
                            
                            <th></th>
                            <th scope="col">Product</th>
                            <th> Photo</th>
                            <th > Size</th>
                            <th style="text-align: center;" >Quantity</th>
                            <th scope="col">Price</th>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            <th style="display:none;"></th>
                            
                        </tr>
                    </thead>

                
                    <tbody>
                        <?php foreach ($cartlistresult as $wishlist ){ ?>
                        <tr>
                            <td>
                                <!-- Checkbox to select the shoe -->
                                <input type="checkbox" name="shoeid[]" class="flat-red wishlist-checkbox" value="<?php echo htmlspecialchars($wishlist['product_id']); ?>">
                               <!-- Hidden inputs to store additional details if this item is checked -->
                                <input type="hidden" name="shoe_id[<?php echo $wishlist['product_id']; ?>]" value="<?php echo htmlspecialchars($wishlist['product_id']); ?>">
                                <input type="hidden" name="size[<?php echo $wishlist['product_id']; ?>]" value="<?php echo htmlspecialchars($wishlist['size']); ?>">
                                <input type="hidden" name="quantity[<?php echo $wishlist['product_id']; ?>]" value="<?php echo htmlspecialchars($wishlist['quantity_cart']); ?>">
                                <input type="hidden" name="userid" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                                 
                                <button type="button" class="delcartbtn btn btn-danger marginleftmore marginbottom " ><i class="fa fa-trash" aria-hidden="true"></i></button> 
                            
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

                            <td > <span class="ml-3"> <?php echo $wishlist['size'] ?></span> </td>

                            <td style="text-align: center;">
                                <div class="product_count mt-4">
                                    <input type="text" name="qty[]" id="sst_<?php echo $wishlist['product_id']; ?>" maxlength="12" value="<?php echo $wishlist['quantity_cart']; ?>" title="Quantity:" class="input-text qty" onchange="update_cart_qty(<?php echo $wishlist['product_id']; ?>, <?php echo $wishlist['user_id']; ?>, <?php echo $wishlist['size']; ?>)">
                                    
                                    <div class="arrowsbtn">
                                        <button class="increase increaseqty items-count arrowup border" 
                                            type="button" 
                                            data-product-id="<?php echo $wishlist['product_id']; ?>" 
                                            data-size-id="<?php echo $wishlist['size_id']; ?>"> 
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                        <button class="reduced reducedqty items-count arrowdown border" 
                                            type="button" 
                                            data-product-id="<?php echo $wishlist['product_id']; ?>"
                                            data-size-id="<?php echo $wishlist['size_id']; ?>">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class=''>
                                    <input type="hidden" id="baseprice_<?php echo $wishlist['product_id']; ?>" value="<?php echo $wishlist['price'] ?>">
                                <h5>₱ <span id="total_price_<?php echo $wishlist['product_id']; ?>"><?php echo number_format($wishlist['price']* $wishlist['quantity_cart'], 2); ?></span></h5>

                                </div>
                            </td>
                            
                            <td style="display:none;"> <?php echo htmlspecialchars($wishlist['user_id']); ?></td>
                            <td  style="display:none;"> <?php echo htmlspecialchars($wishlist['product_id']); ?></td>
                            <td  style="display:none;"> <?php echo htmlspecialchars($wishlist['size']); ?></td>
                            
                            
                        </tr>
                        <?php } ?>
                       
                        
                        
                        
                      
                        
                    </tbody>


                </table>
                <?php if(!empty($cartlistresult)){?>
                
                <div class="my-2 " >
                    <h2 class="mr-5 " style=" text-align: justify; text-align-last: right;" > Total Amount: ₱ <span id="totalAmount"  >0.00</span> </h2>
                </div>
                <?php }else{?>
                    <h2 class="mr-2 " style=" text-align: justify; text-align-last: center;">  <a href="shop.php"> Please click here to Shop </h2>
                   <?php }?>
                <hr>
                <?php if(!empty($cartlistresult)){?>
                <div class="my-2">
                    <a class="gray_btn" href="addToCardPage.php">Update Cart</a>
                    <button type="submit" class="red_btn ml-2" name="delall"> Delete All Item </button> 
                </div>
                <hr>
                <div class="d-flex justify-content-end my-4">
                    <a class="gray_btn me-2" href="shop.php">Continue Shopping</a>
                    <button type="submit" class="primary-btn addToCartBtn " name="checkout" >Check out</button>
                    
                    
                </div>
                <hr>
                <?php } ?>
                
            </div>
        </div>

    </div>
    </form>
</section>





<script>
    document.addEventListener('DOMContentLoaded', function () {
    
    
});

</script>

<?php include('includes/footer.php'); ?>
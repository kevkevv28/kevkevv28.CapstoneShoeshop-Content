<?php

    require_once 'includes/config_session.inc.php';
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing the shoes";
        header("Location: loginPage.php");

    }
    if(isset($_GET['prodid'])){
        $prodid = $_GET['prodid'];
        
    }else{
        header("Location: shop.php");
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

    if (isset( $_SESSION['Shoes_already'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Shoes already in cart!',
                    text: '". $_SESSION['Shoes_already']. "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset( $_SESSION['Shoes_already']);
    }

    if (isset( $_SESSION['Unavailable'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Shoes Unavailable!',
                    text: '". $_SESSION['Unavailable']. "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset( $_SESSION['Unavailable']);
    }
    

    include('includes/topbar.php');

   
    
    require_once 'includes/dbh.inc.php';
    require_once 'includes/products_model.inc.php';
    require_once 'includes/products_contrl.inc.php';

 
    $productResults = get_single_product($pdo, $prodid);
    $sizesResults = get_size($pdo);
    $stockresult =  get_stocks($pdo, $_GET['prodid']);

    include_once 'includes/modal_product_single.php';

    
    
    if (isset($_SESSION["errors_wishlist"]['sizeNotSelected'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: '".implode(" ", $_SESSION["errors_wishlist"]) ."',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['errors_wishlist']);
    }



   
?>
 
<!-- Start Content -->
<div class="container custom-container py-5 ">
        <div class="row">





<!--  i put the foreach here so that i can also use it for the image -->
          <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <?php foreach ($productResults as $product ){?>
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3 productphoto">
                        <img class="card-img img-fluid margintop " src="assets/shoesphotos/<?php echo $product['product_img_name'] ?>" alt="Card image cap" id="product-detail">
                    </div>
                    
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                    
                        <div class="card-body">
                            <h1 class="h2"><?php echo $product['product_name']; ?></h1>
                            <p class="h3 py-2">₱ <?php echo number_format($product['price'], 2); ?></p>
                            
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?php echo $product['brandName']; ?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p><?php echo $product['product_description']; ?></p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6> Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong> <?php echo $product['color']; ?> </strong></p>
                                </li>
                                <li class="list-inline-item">
                                    <span class="default-address" style="margin-top: 248px; margin-right: 50px;">
                                    All Stocks: 
                                    <span>
                                        <?php 
                                        echo !empty($stockresult['allstocks']) ? $stockresult['allstocks'] : ' No stock Available'; 
                                        ?>
                                    </span>
                                </span>
                                    
                                </li>

                            </ul>

                            
                            <form id="productsingle" action="includes/products.inc.php" method="POST">
                                <?php $result = get_user_wish($pdo, $_SESSION['user_id']); ?>
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" name="product_id" value="<?php echo $prodid ?>">
                                <input type="hidden" name="addwishlist" value="1"> <!-- Added hidden input -->

                                <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size:</li>
                                        <?php foreach ($sizesResults as $size): ?>
                                        <li class="list-inline-item">
                                            <span class="btn btn-success btn-size" data-size-id="<?php echo $size['id']; ?>" data-size="<?php echo $size['size']; ?>">
                                                <?php echo $size['size']; ?>
                                            </span>
                                        </li>
                                        <?php endforeach; ?>
                                        

                                       
                                    </ul>
                                    <input type="hidden" name="size" id="selectedSize" value=""> <!-- Hidden input to hold the selected size -->
                                    <input type="hidden" name="size_id" id="selectedSizeId" value=""> <!-- Hidden input to hold the selected size ID -->
                                </div>

                                   
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity

                                                <input type="hidden" name="product-quantity" id="product-quantity" value="1"> <!-- Default value -->
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minuses">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-values">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-pluses">+</span></li>
                                        </ul>
                                    </div>

                                    <div class="col-auto">
                                            <!--/* Heart button for wish list*/ -->
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-success btn-lg" id="wishlist-button"><i class="fa fa-fw fa-heart mr-1"></i>Add To Wishlist <i class="fa fa-fw fa-heart mr-1"></i></button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="addtocart"  ><i class="fa fa-fw fa-shopping-cart mr-1"></i>Add To Cart <i class="fa fa-fw fa-shopping-cart mr-1"></i></button>
                                    </div>
                                </div>  




                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-success btn-lg" id="buy-btn">Buy</button>
                                    </div>
                                    




                                </div>
                            </form>
                           
                        <?php } ?>
                        </div>
                    </div>
                    
                </div>
                
            </div>


            <div class="row" id="reviewsSection">
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0 reviews-card">
                        <div class="card-body">
                            <h2 class="h4 text-primary mb-4 reviews-title">Reviews</h2>
                            
                            <!-- Reviews Container -->
                            <div class="reviews-container p-3 mb-4 border rounded bg-light">
                                <!-- Example Review -->
                                <div class="review d-flex p-3 mb-3 border-bottom">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                                        U1
                                    </div>
                                    <div>
                                        <strong class="review-user d-block text-dark">User1</strong>
                                        <div class="stars text-warning">
                                            ★★★★☆
                                        </div>
                                        <p class="review-text mb-1 text-secondary">Great quality shoes!</p>
                                        <small class="review-date text-muted">Posted on: 2024-12-05</small>
                                    </div>
                                </div>
                                
                                <!-- Example Review -->
                                <div class="review d-flex p-3 mb-3 border-bottom">
                                    <div class="avatar bg-success text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px; font-size: 1.25rem;">
                                        U2
                                    </div>
                                    <div>
                                        <strong class="review-user d-block text-dark">User2</strong>
                                        <div class="stars text-warning">
                                            ★★★★★
                                        </div>
                                        <p class="review-text mb-1 text-secondary">Comfortable and stylish.</p>
                                        <small class="review-date text-muted">Posted on: 2024-12-04</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Submission -->
                            <div class="review-form">
                                <form action="includes/review.inc.php" method="post">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_GET['prodid'] ?>">
                                <label for="reviewStars" class="form-label">Rate this product:</label>
                                <div id="reviewStars" class="star-input mb-3">
                                    <span class="star" data-value="5">★</span>
                                    <span class="star" data-value="4">★</span>
                                    <span class="star" data-value="3">★</span>
                                    <span class="star" data-value="2">★</span>
                                    <span class="star" data-value="1">★</span>
                                </div>
                                <textarea id="reviewText" class="form-control mb-3 reviews-input" placeholder="Write your review here..." rows="3"></textarea>
                                <button id="submitReview" class="btn btn-primary w-100 reviews-submit-btn">Submit Review</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Suggested Shoes </h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">

                <div class="p-2 pb-3">
                    <div class="product-wap card rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="assets/img/shop_08.jpg">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="shop-single.html" class="h3 text-decoration-none">Red Clothing</a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li>M/L/X/XL</li>
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">$20.00</p>
                        </div>
                    </div>
                </div>

                

                

                

            </div>


        </div>
    </section>
    <!-- End Article -->  





           
        </div>






                
                
        </div>

        </div>
    </div>
    <!-- End Content -->

    <?php if (!empty($_SESSION['errors_product'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Warning!',
            text: '<?php echo implode(" ", $_SESSION["errors_product"]); ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
    <?php 
    unset($_SESSION["errors_product"])
    ?>

 
</script>
<?php  endif; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

    // Listen for size button click
    const sizeButtons = document.querySelectorAll('.btn-size');

    sizeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the size ID and size name
            const sizeId = this.getAttribute('data-size-id');
            const size = this.getAttribute('data-size');

            // Set the selected size in the hidden input fields
            document.getElementById('selectedSize').value = size;
            document.getElementById('selectedSizeId').value = sizeId;

            // Send an AJAX request to get stock based on the selected size and product
            getStockForSize(sizeId);
        });
    });

    // Function to fetch stock data from the server
    function getStockForSize(sizeId) {
        // Get the product ID from the hidden input field
        const productId = document.querySelector('input[name="product_id"]').value;

        // Send AJAX request to get stock data for the selected size and product
        fetch('includes/get_stock.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                product_id: productId,
                size_id: sizeId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.stock !== undefined) {
                // Update the stock display based on the response
                updateStockDisplay(data.stock);
                // Set the maximum quantity to the stock value
                setMaxQuantity(data.stock);
            } else {
                console.error('Stock data not received or invalid response');
            }
        })
        .catch(error => {
            console.error('Error fetching stock:', error);
        });
    }

    // Function to update the stock display
    function updateStockDisplay(stock) {
    // Hide the 'All Stocks' span
    const allStocksSpan = document.querySelector('.default-address');
    if (allStocksSpan) {
        allStocksSpan.style.display = 'none';
    }

    // Display the stock or "Stocks unavailable"
    const stockDisplay = document.querySelector('.default-address');
    if (stockDisplay) {
        if (!stock || stock === 0) { // Check if stock is false or 0
            stockDisplay.innerHTML = "Stocks unavailable";
        } else {
            stockDisplay.innerHTML = `Stocks: <span>${stock}</span>`;
        }
        stockDisplay.style.display = 'block';
    }
}


    // Declare the functions outside of setMaxQuantity so they can be reused
    function increaseQuantity(stock, varValue, quantityInput) {
        let currentValue = parseInt(varValue.innerHTML);
        if (currentValue < stock) {
            varValue.innerHTML = currentValue + 1;
            quantityInput.value = currentValue + 1;
        }
    }

    function decreaseQuantity(varValue, quantityInput) {
        let currentValue = parseInt(varValue.innerHTML);
        if (currentValue > 1) {
            varValue.innerHTML = currentValue - 1;
            quantityInput.value = currentValue - 1;
        }
    }

    // Function to set the maximum quantity based on available stock
    function setMaxQuantity(stock) {
        const quantityInput = document.getElementById('product-quantity');
        const btnPlus = document.getElementById('btn-pluses');
        const btnMinus = document.getElementById('btn-minuses');
        const varValue = document.getElementById('var-values');
        
        // Set the maximum quantity for the input field
        quantityInput.max = stock;

        // Reset the quantity to 1 on size selection
        varValue.innerHTML = '1';
        quantityInput.value = 1;

        // Disable the "plus" button if no stock is available
        btnPlus.disabled = stock === 0;

        // Remove any existing click listeners before adding new ones
        btnPlus.onclick = () => increaseQuantity(stock, varValue, quantityInput);
        btnMinus.onclick = () => decreaseQuantity(varValue, quantityInput);
    }




    });

    document.addEventListener('DOMContentLoaded', function () {

    // When the user clicks the "Add To Wishlist" button, trigger the modal
    document.getElementById('wishlist-button').addEventListener('click', function () {
        // Show the modal
        var wishlistModal = new bootstrap.Modal(document.getElementById('wishlistModal'));
        wishlistModal.show();
    });

    // When the user clicks the "Confirm" button inside the modal, submit the form
    document.getElementById('confirm-add-wishlist').addEventListener('click', function () {
        // Submit the form with the id 'wishlist-form'
        document.getElementById('productsingle').submit();
    });

    });

    

    document.addEventListener('DOMContentLoaded', function () {
    // Select the buy button
    const buyButton = document.getElementById('buy-btn');

    // Add a click event listener to the buy button
    buyButton.addEventListener('click', function () {
        // Retrieve the user ID and product ID
        const userId = document.querySelector('input[name="user_id"]').value;
        const productId = document.querySelector('input[name="product_id"]').value;

        // Get the selected size and size ID
        const selectedSize = document.getElementById('selectedSize').value;
        const selectedSizeId = document.getElementById('selectedSizeId').value;

        // Get the product quantity
        const productQuantity = document.getElementById('product-quantity').value;

        // Validate required fields
        if (!selectedSize || !productQuantity || !productId) {
            alert("Please ensure size, quantity, and product are selected before proceeding.");
            return;
        }

        // Create a form to submit the data to checkout.php
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'checkout.php';

        // Add required fields as hidden inputs
        const checkoutInput = document.createElement('input');
        checkoutInput.type = 'hidden';
        checkoutInput.name = 'checkout';
        checkoutInput.value = '1'; // Arbitrary value to signal the POST request
        form.appendChild(checkoutInput);

        const shoeIdInput = document.createElement('input');
        shoeIdInput.type = 'hidden';
        shoeIdInput.name = `shoe_id[${productId}]`; // Array indexed by shoe_id
        shoeIdInput.value = productId;
        form.appendChild(shoeIdInput);

        const sizeInput = document.createElement('input');
        sizeInput.type = 'hidden';
        sizeInput.name = `size[${productId}]`; // Array indexed by shoe_id
        sizeInput.value = selectedSize;
        form.appendChild(sizeInput);

        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = `quantity[${productId}]`; // Array indexed by shoe_id
        quantityInput.value = productQuantity;
        form.appendChild(quantityInput);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    });
});


</script>


    


<?php include('includes/footer.php'); ?>
<?php 



 if (isset($_GET['wishlist']) && $_GET['wishlist'] === 'already' && isset($_SESSION["errors_wishlist"]['already_have'])){
    echo "
    <script>
    document.addEventListener('DOMContentLoaded', function() {
         Swal.fire({
            title: 'Product is Already in Wishlist!!',
            text: 'Redirecting to wishlist page',
            icon: 'error', // Try different icons: 'success', 'error', 'warning', 'info', 'question'
            confirmButtonText: 'OK'
        });

        // Redirect after 5 seconds
        setTimeout(function() {
            window.location.href = 'wishlist.php'; // Change 'anotherpage.php' to the target page
        }, 2000); // 5000 milliseconds = 5 seconds
        });
    </script>
    ";
    unset($_SESSION["errors_wishlist"]);
}



if (isset($_GET['wishlist']) && $_GET['wishlist'] === 'success' && isset($_SESSION['wishlist'])) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Wishlist Successfully Added',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            // Redirect after 5 seconds
        setTimeout(function() {
            window.location.href = 'wishlist.php'; // Change 'anotherpage.php' to the target page
        }, 2000); // 5000 milliseconds = 5 seconds
        
    });
    </script>
    ";
    
    // Optionally clear the session variable after showing the message
    unset($_SESSION['wishlist']);
}
?>

<script>
   // Handle star rating selection from left to right
document.querySelectorAll('.star-input .star').forEach((star, index) => {
    star.addEventListener('click', function () {
        // Remove 'selected' class from all stars
        document.querySelectorAll('.star-input .star').forEach(s => s.classList.remove('selected'));

        // Add 'selected' class to clicked star and all previous ones
        let siblings = Array.from(this.parentNode.children).slice(0, index + 1);
        siblings.forEach(sibling => sibling.classList.add('selected'));

        // Save the rating value (optional)
        const rating = this.getAttribute('data-value');
        console.log('Selected rating:', rating);
    });

    // Optional: Add hover effect for better user experience
    star.addEventListener('mouseover', function () {
        document.querySelectorAll('.star-input .star').forEach(s => s.classList.remove('hovered'));
        let siblings = Array.from(this.parentNode.children).slice(0, index + 1);
        siblings.forEach(sibling => sibling.classList.add('hovered'));
    });

    star.addEventListener('mouseout', function () {
        document.querySelectorAll('.star-input .star').forEach(s => s.classList.remove('hovered'));
    });
});



    // JavaScript to handle click event on size buttons
    document.querySelectorAll('.btn-size').forEach(function(element) {
        element.addEventListener('click', function() {
            // Get the size and size-id from the clicked button
            var size = this.getAttribute('data-size');
            var sizeId = this.getAttribute('data-size-id');

            // Set the values in the hidden inputs
            document.getElementById('selectedSize').value = size;
            document.getElementById('selectedSizeId').value = sizeId;

            // Submit the form
            document.getElementById('sizeForm').submit();
        });
    });

</script>
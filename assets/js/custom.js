    const backToTopBtn = document.getElementById("backToTopBtn");

    // Show or hide the button when scrolling
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

        // Show the button with a fade-in when the user scrolls past 50% of the page
        if (scrollPosition > scrollHeight * 0.5) {
            backToTopBtn.style.opacity = "1"; // Fade in
            backToTopBtn.style.pointerEvents = "auto"; // Enable clickability
        } else {
            backToTopBtn.style.opacity = "0"; // Fade out
            backToTopBtn.style.pointerEvents = "none"; // Disable clickability
        }
    }

    // Scroll to top when button is clicked
    backToTopBtn.addEventListener("click", function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });



    /* Javascript for showing footer */
    document.addEventListener("DOMContentLoaded", function () {
        var footer = document.querySelector("footer");
    
        // Initially hide the footer (opacity set to 0 in CSS)
        footer.classList.remove("show");
    
        // Function to check if the page has scroll
        function checkForScroll() {
            if (document.documentElement.scrollHeight < window.innerHeight) {
                window.addEventListener("scroll", function () {
                    if (window.scrollY > 100) {
                        footer.classList.add("show"); // Add class to show footer
                    } else {
                        footer.classList.remove("show"); // Remove class to hide footer
                    }
                });
            } else {
                footer.classList.add("show"); // Show the footer if there's no scroll
            }
        }
    
        // Check for scroll on page load
        checkForScroll();
    
        // Optionally, recheck if the content changes (e.g., dynamic content)
        window.addEventListener("resize", checkForScroll);
    });
    


    /* Timer for Registration Complete */

    document.addEventListener("DOMContentLoaded", function () {
        var countdownElement = document.getElementById("countdown");
        var timeLeft = 3;

        var countdownInterval = setInterval(function () {
            timeLeft--;
            countdownElement.innerHTML = timeLeft;

            // When time reaches 0, redirect to login page
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "loginPage.php"; // Redirect to login page
            }
        }, 1000); // Countdown every second
    });

    document.addEventListener("DOMContentLoaded", function () {
        var countdownloginElement = document.getElementById("countdownlogin");
        var timeLeft = 3;

        var countdownInterval = setInterval(function () {
            timeLeft--;
            countdownloginElement.innerHTML = timeLeft;

            // When time reaches 0, redirect to login page
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                window.location.href = "index.php"; // Redirect to login page
            }
        }, 1000); // Countdown every second
    });

/* to hide Already login alert */

  // Set a timeout to hide and remove the alert after 3 seconds
  setTimeout(function() {
    let alertElement = document.getElementById('loginAlert');
    if (alertElement) {
        // Add fade-out transition
        alertElement.style.transition = "opacity 0.5s";
        alertElement.style.opacity = "0";
        
        // Wait for the fade-out transition to complete (0.5s) before removing
        setTimeout(function() {
            alertElement.remove();  // Remove the entire element from DOM
        }, 500);  // Wait for the fade-out to finish
    }
}, 3000);

   


document.addEventListener('DOMContentLoaded', function() {
    // Select the buttons and the hidden input
    const sizeButtons = document.querySelectorAll('.btn-size');
    const sizeInput = document.getElementById('product-size');

    sizeButtons.forEach(button => {
        // Add a click event listener to each button
        button.addEventListener('click', function() {
            // Get the size ID from the clicked button's data attribute
            const selectedSize = this.getAttribute('data-size-id');
            
            // Update the hidden input value with the selected size ID
            sizeInput.value = selectedSize;

            // Highlight the selected button by adding a class
            sizeButtons.forEach(btn => btn.classList.remove('btn-selected'));
            this.classList.add('btn-selected');
        });
    });
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

$(document).ready(function() {
    $('#wishlist_tble').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false, 
        "ordering": false,  
        "info": false,     
        "autoWidth": false, 
        "responsive": true, 
        "columnDefs": [
            { "targets": [5, 6], "visible": false }  
        ],
        "createdRow": function(row, data, dataIndex) {
            // Check if the row has the `data-ignore` attribute
            if ($(row).attr('data-ignore') === 'true') {
                $(row).addClass('no-sort'); // Add a class to mark this row
            }
        }
    });
});



$(document).ready(function() {
    var table = $('#wishlist_tble').DataTable(); // Initialize DataTable

    // Event delegation for delete button click
    $('#wishlist_tble').on('click', '.delwishbtn', function() {
        var $tr = $(this).closest('tr'); // Get the closest row

        // Get row data using DataTables API
        var rowData = table.row($tr).data();

        console.log('Row data:', rowData); // Check the row data in console

        // Use the correct indices based on your rowData array structure
        $('#del_userid').val(rowData[5]); // Replace 4 with the correct index
        $('#del_productid').val(rowData[6]); // Replace 5 with the correct index
        $('#del_size').val(rowData[7]);
        // Show the delete modal
        $('#delwishmodal').modal('show');
    });
});

$(document).ready(function() {
    var table = $('#cart_tble').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false, 
        "ordering": false,  
        "info": false,     
        "autoWidth": false, 
        "responsive": true,
        "columnDefs": [
            { "targets": [6, 7, 8], "visible": false }  
        ],
    }); // Initialize DataTable

    // Event delegation for delete button click
    $('#cart_tble').on('click', '.delcartbtn', function() {
        var $tr = $(this).closest('tr'); // Get the closest row

        // Get row data using DataTables API
        var rowData = table.row($tr).data();

        console.log('Row data:', rowData); // Check the row data in console

        // Use the correct indices based on your rowData array structure
        $('#del_useridcart').val(rowData[6]); // Replace 4 with the correct index
        $('#del_productidcart').val(rowData[7]); // Replace 5 with the correct index
        
        // Show the delete modal
        $('#delwishmodal').modal('show');
    });


    // Event delegation for delete button click
    $('#cart_tble').on('click', '.increaseqty', function() {
        var $tr = $(this).closest('tr'); // Get the closest row

        // Get row data using DataTables API
        var rowData = table.row($tr).data();

        console.log('Row data:', rowData); // Check the row data in console

        // Use the correct indices based on your rowData array structure
        var useridcart = rowData[6];
        var productidcart = rowData[7];
        var size = rowData[8];
        
         // Redirect to another PHP file (update_cart.php) with parameters
         window.location.href = 'includes/cart.inc.php?action=increase&useridcart=' + useridcart + '&productidcart=' + productidcart + '&size=' + size ;
       
    });

    // Event delegation for delete button click
    $('#cart_tble').on('click', '.reducedqty', function() {
        var $tr = $(this).closest('tr'); // Get the closest row

        // Get row data using DataTables API
        var rowData = table.row($tr).data();

        console.log('Row data:', rowData); // Check the row data in console

        // Assuming rowData[6] is useridcart and rowData[7] is productidcart
        var useridcart = rowData[6];
        var productidcart = rowData[7];
        var size = rowData[8];

        // Redirect to another PHP file (update_cart.php) with parameters
        window.location.href = 'includes/cart.inc.php?action=decrease&useridcart=' + useridcart + '&productidcart=' + productidcart + '&size=' + size;
        
       
    });
});

function calculateTotalAndUpdate(productId, price) {
    var qty = document.getElementById('sst_' + productId).value;

    if (!isNaN(qty) && qty > 0) {
        // Update the total price based on the current quantity
        var totalPrice = qty * price;
        document.getElementById('total_price_' + productId).innerText = totalPrice.toFixed(2);
    } else {
        // If qty is invalid, fallback to the product's original price
        document.getElementById('total_price_' + productId).innerText = price.toFixed(2);
    }
}

function update_cart_qty(productId, userid, Shoesize) {
    var qty = document.getElementById('sst_' + productId).value;
    var useridcart = userid;
    var productidcart = productId;
    var size = Shoesize;

    if (!isNaN(qty) && qty > 0) {
        // Update the total price based on the current quantity
        window.location.href = 'includes/cart.inc.php?action=updatecartqty&useridcart=' + useridcart + '&productidcart=' + productidcart + '&qty=' + qty + '&size=' + size;
    } else {
        // If qty is invalid, fallback to the product's original price
        window.location.href = 'addToCardPage.php';
    }
}

// Function to handle the arrow up click
function increaseQuantity(productId, price) {
    var qtyField = document.getElementById('sst_' + productId);
    var currentQty = parseInt(qtyField.value);

    // Check if current quantity is a valid number
    if (!isNaN(currentQty)) {
        // Increase the quantity by 1
        qtyField.value = currentQty + 1;
        // Recalculate the total price
        calculateTotalAndUpdate(productId, price);
        
    }
}

function decreaseQuantity(productId, price) {
    var qtyField = document.getElementById('sst_' + productId);
    var currentQty = parseInt(qtyField.value);

    // Only decrease the quantity if it's greater than 1
    if (!isNaN(currentQty) && currentQty > 1) {
        qtyField.value = currentQty - 1;
        calculateTotalAndUpdate(productId, price);
    }
}


function updateTotalAmount() {
    let totalAmount = 0;

    // Get all checked checkboxes
    const checkboxes = document.querySelectorAll('.wishlist-checkbox:checked');

    // Loop through each checked checkbox
    checkboxes.forEach(function(checkbox) {
        const productId = checkbox.value; // Get the product ID
        const qtyInput = document.getElementById('sst_' + productId); // Get the corresponding quantity input
        const pricePerItem = parseFloat(document.getElementById('baseprice_' + productId).value); // Get the price per item

        
        // Get the quantity and calculate total for this item
        const qty = parseInt(qtyInput.value) || 0; // Default to 0 if qty is not a valid number

        if (qty > 0) {
            const itemTotal = pricePerItem * qty; // Calculate total for this item
            totalAmount += itemTotal; // Add to total amount
            // Update individual total price for this item
            document.getElementById('total_price_' + productId).innerText = formatNumber(itemTotal);
        } else {
            document.getElementById('total_price_' + productId).innerText = '0.00'; // Set to 0 if quantity is 0
        }
    });

    // Update the total amount span
    document.getElementById('totalAmount').innerText = formatNumber(totalAmount); // Format to 2 decimal places
    
}

// Utility function to format number with commas and two decimal places
function formatNumber(number) {
    return new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(number);
}

document.addEventListener('DOMContentLoaded', function() {
    // Function to calculate and update total amount
    

    // Attach event listeners to all checkboxes
    const checkboxes = document.querySelectorAll('.wishlist-checkbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', updateTotalAmount); // Update total when checkbox changes
    });

    // Attach event listeners to all quantity inputs
    const quantityInputs = document.querySelectorAll('.qty');
    quantityInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            updateTotalAmount(); // Update total amount when quantity changes
        });
    });

    // Initial call to set total on page load
    updateTotalAmount();
});

document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('footer');
    const bodyHeight = document.body.offsetHeight;
    const windowHeight = window.innerHeight;

    if (bodyHeight < windowHeight) {
        // Content is larger than the viewport, set footer as relative
        footer.classList.add('footer-relative');
    } else {
        // Content fits within the viewport, footer stays absolute
        footer.classList.remove('footer-relative');
    }
});





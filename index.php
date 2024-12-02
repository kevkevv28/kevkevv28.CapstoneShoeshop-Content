<?php
require_once 'includes/config_session.inc.php';
include('includes/header.php');

// Display session alerts/messages
function displaySessionAlert($key, $title = '', $icon = 'info', $unset = true) {
    if (isset($_SESSION[$key])) {
        $message = is_array($_SESSION[$key]) ? implode(" ", $_SESSION[$key]) : $_SESSION[$key];
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '{$title}',
                    text: '{$message}',
                    icon: '{$icon}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        if ($unset) {
            unset($_SESSION[$key]);
        }
    }
}

// Handle session messages
if (isset($_SESSION['already'])) {
    echo "<div id='loginAlert' class='alert alert-warning alert-dismissible fade show' role='alert'>
            {$_SESSION['already']}
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
    unset($_SESSION['already']);
}

displaySessionAlert('logout', '', 'error');
displaySessionAlert('success_login', 'Success!', 'success');
displaySessionAlert('checkout_success', 'Thank you for purchasing!', 'success');

include('includes/topbar.php');
include 'includes/carousel.php';
include 'includes/dbh.inc.php';

// Render Carousel
renderCarousel("template-mo-zay-hero-carousel", "tbl_slider2", $pdo);
renderMiddleHeaderAndBestSellers($pdo);

?>


<?php
// Render second carousel and include footer
renderCarousel("template-mo-zay-hero-carousel-2", "tbl_slider3", $pdo);
include('includes/footer.php');
?>

<script>
document.addEventListener("DOMContentLoaded", (event) => {
    const successMessage = sessionStorage.getItem("checkout_Error");
    if (successMessage) {
        const successData = JSON.parse(successMessage);

        Swal.fire({
            title: 'Payment Error!',
            text: successData.Order_success,
            icon: 'error',
            confirmButtonText: 'OK'
        });

        sessionStorage.removeItem("checkout_Error");
    }
});
</script>

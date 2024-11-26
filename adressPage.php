<?php
    require_once 'includes/config_session.inc.php';
    include('includes/header.php');
    if(!isset($_SESSION['user_id'])){
        $_SESSION['pleaselogin'] = "Please Log in First before seeing wishlist";
        header("Location: loginPage.php");

    }
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

    if (isset($_SESSION['address_success'])) {
        
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '".implode(" ", $_SESSION['address_success']) ."',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
            
        </script>
        ";
        
        // Optionally clear the session variable after showing the message
        unset($_SESSION['address_success']);
    }

    include('includes/topbar.php');
    include_once 'includes/AddressAddmodal.php';
    include('includes/products_model.inc.php');

    $addressresult = get_user_addresses($pdo, $_SESSION['user_id']);
?>

<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center ">
            <h1 class="h1">ADDRESS PAGE</h1>
            <button type="button" id="btnadd" class="btn btn- btnadress"> ADD ADDRESS </button>
        </div>
    </div>

 <!-- Start Contact -->
 <div class="container height py-5">
        <div class="row py-5">

                <div class="row">
                    <div class=" center">
                        <h3 class="center">ADDRESSES</h3>
                        <?php foreach ($addressresult as $address): ?>
                            <div class="container each_address mb-3 d-flex justify-content-between align-items-center  p-3">
                                <div>
                                    <p class="address_p mt-3">
                                        <?php echo $address["address"] ?>, 
                                        <?php echo $address["brgy_street"] ?><br>
                                        <?php echo $address["city"] ?><br>
                                        <?php echo $address["mobile_no"] ?>

                                        
                                    </p>
                                </div>
                                <div class="button-group ">
                                    <button class="btn btn-edit" id="addresseditbtn" 
                                            data-id = "<?php echo $address["id"];?>"        
                                            data-address="<?php echo $address["address"]; ?>"
                                            data-brgy_street="<?php echo $address["brgy_street"]; ?>"
                                            data-city="<?php echo $address["city"]; ?>"
                                            data-zipcode="<?php echo $address["zipcode"]; ?>"
                                            data-mobile_no="<?php echo $address["mobile_no"]; ?>"
                                            data-default="<?php echo $address["default"]; ?>">Edit</button>

                                    <button class="btn btn-delete" id="addressdelete"
                                        data-id-for-delete = "<?php echo $address["id"];?> "> Delete</button>

                                    <?php if ($address["default"] === 1): ?>
                                        <span class="default-address"> ( Default Address )</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <hr>
                            
                        <?php endforeach; ?>
                    </div>
                </div>
                
        </div>
        
    </div>
    <!-- End Contact -->


    <script>
    document.addEventListener('DOMContentLoaded', function () {

    // When the user clicks the "Add To Wishlist" button, trigger the modal
    document.getElementById('btnadd').addEventListener('click', function () {
        // Show the modal
        var addresslistModal = new bootstrap.Modal(document.getElementById('addressModal'));
        addresslistModal.show();
    });

   

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            // Get data from the clicked button
            const id = button.getAttribute('data-id');
            const address = button.getAttribute('data-address');
            const brgyStreet = button.getAttribute('data-brgy_street');
            const city = button.getAttribute('data-city');
            const zip = button.getAttribute('data-zipcode');
            const mobileNo = button.getAttribute('data-mobile_no');
            const isDefault = button.getAttribute('data-default');

            // Set the values in the modal inputs
            document.querySelector('#addressEditModal input[name="id"]').value = id;
            document.querySelector('#addressEditModal input[name="address"]').value = address;
            document.querySelector('#addressEditModal input[name="streetandbrgy"]').value = brgyStreet;
            document.querySelector('#addressEditModal input[name="city"]').value = city;
            document.querySelector('#addressEditModal input[name="postal"]').value = zip;
            document.querySelector('#addressEditModal input[name="phone"]').value = mobileNo;
            document.querySelector('#addressEditModal input[name="default"]').checked = (isDefault == "1");

            var addresslistModal = new bootstrap.Modal(document.getElementById('addressEditModal'));
            addresslistModal.show();
        });
    });   
    
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            // Get data from the clicked button
            const id = button.getAttribute('data-id-for-delete');
            

            // Set the values in the modal inputs
            document.querySelector('#addressdeleteModal input[name="id"]').value = id;

            var addressdeleteModal = new bootstrap.Modal(document.getElementById('addressdeleteModal'));
            addressdeleteModal.show();
        });
    });

    });
    </script>

<?php include('includes/footer.php'); ?>
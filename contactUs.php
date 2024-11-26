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

    if (isset($_SESSION['statusemail'])) {
    // Check if $_SESSION['statusemail'] is an array
    $message = is_array($_SESSION['statusemail']) ? implode(" ", $_SESSION['statusemail']) : $_SESSION['statusemail'];
    
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Thank you for Contacting Us!',
                    text: '" . $message . "',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";

        // Optionally clear the session variable after showing the message
        unset($_SESSION['statusemail']);
    }
   
?>


<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1">Contact Us</h1>
            <p>
            Our dedicated support team is always here to assist you with any issues or inquiries you may have. Whether you're facing a technical glitch, need more information about our services, or just have a general question, we're eager to help. Please include as much detail as possible in your email so we can provide the most effective assistance. We look forward to hearing from you and resolving your concerns swiftly. Thank you for choosing our services!
            </p>
        </div>
    </div>

 <!-- Start Contact -->
 <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" method="post" role="form" action="includes/sendContactMail.php">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname">Name</label>
                        <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail">Email</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject">Subject</label>
                    <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="mb-3">
                    <label for="inputmessage">Message</label>
                    <textarea class="form-control mt-1" id="message" name="message" placeholder="Message" rows="8" required></textarea>
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                    <button type="button" class="btn btn-success btn-lg px-3" data-bs-toggle="modal" data-bs-target="#confirmModal" onclick="copyFormData()">Let’s Talk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Contact -->



   <!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Your Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to send this email? Please confirm.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="confirmForm" method="post" action="includes/sendContactMail.php">
                    <input type="hidden" name="name" id="modalName">
                    <input type="hidden" name="email" id="modalEmail">
                    <input type="hidden" name="subject" id="modalSubject">
                    <input type="hidden" name="message" id="modalMessage">
                    <button type="submit" class="btn btn-primary" name="submitContact">Yes, Send Email</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function copyFormData() {
    // Copy data from the main form to the modal form
    document.getElementById('modalName').value = document.getElementById('name').value;
    document.getElementById('modalEmail').value = document.getElementById('email').value;
    document.getElementById('modalSubject').value = document.getElementById('subject').value;
    document.getElementById('modalMessage').value = document.getElementById('message').value;
}

</script>

   

<?php include('includes/footer.php'); ?>

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

   
?>

        <!-- Start Categories of The Month -->
        <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class=" bold " >About Us</h1>
               
            </div>
        </div>
        <div class="row ">
            
            
            <h1 class=" h1 " >Our Story </h1>

            <p class="textIndent">
                Our siblings' initials inspired the name of our store. The shoe business was launched by my sister, 
            and we decided to follow her path and open a branch in a different municipality.
            </p>
                
          
        </div>
        <div class="row margin-top">

        <h1 class=" h1 " >Our Goal </h1>

        <p class="textIndent">
        The goal is to distribute shoes at a lower cost while maintaining a high standard of quality for our clients. The prices are still worth it, even though they might not be the lowest.
        </p>
            

        </div>
        
        <div class="row">
            
        <h1 class=" h1 " >We Are located at: </h1>

        <ul class="styled-list">
            <li>
            Ibayo Silangan, Naic, Cavite
            </li><br>
            <li>Amaya, Tanza, Cavite</li><br>
            <li>Sahud Ulan, Tanza, Cavite</li>
        </ul>

        </div>

        <div class="row">
            
       

        </div>
    </section>
    <!-- End Categories of The Month -->






<?php include('includes/footer.php'); ?>
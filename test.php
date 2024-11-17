<?php

    require_once 'includes/config_session.inc.php';
    
    

    include('includes/topbar.php');

   
    
    require_once 'includes/dbh.inc.php';
    require_once 'includes/products_model.inc.php';
    require_once 'includes/products_contrl.inc.php';

 




   
?>
 
<!-- Start Content -->





<div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity

                                                <input type="number" name="product-quantity" id="product-quantity" value="1"> <!-- Default value -->
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minuses">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-values">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-pluses">+</span></li>
                                        </ul>
                                    </div>



    <!-- End Content -->



    


<?php include('includes/footer.php'); ?>



<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title fs-5" id="exampleModalLabel"> Add Adress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/products.inc.php" method="POST">
      <div class="modal-body">

        <div class="form-group">
            <label > House Number Or Unit Number</label>
            <input type="text" name="product_name" class="form-control radiuss" placeholder="Enter Product">
        </div>
        
        <div class="form-group">
            <label > Street Name And Barangay </label>
            <input type="text" name="product_qty" class="form-control radiuss" placeholder="Enter Product Quantity">
        </div>
        <div class="form-group">
            <label > City</label>
            <input type="text" name="product_price" class="form-control radiuss" placeholder="Enter Product Price">
        </div>
        <div class="form-group">
            <label > Postal / Zip Code</label>
            <input type="number" name="product_price" class="form-control radiuss" placeholder="Enter Product Price">
        </div>
        <div class="form-group">
            <label > Phone Number</label>
            <input type="number" name="product_price" class="form-control radiuss" placeholder="Enter Product Price">
        </div>

        <label class="containers mt-5 ml-2"> Make Dafault Address
        <input type="checkbox">
        <span class="checkmark"></span>
        </label>

     

        
  

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" name="addproduct" class="btn btn-primary">Add Address</button>
      </div>
      </form>

    </div>
  </div>
</div>

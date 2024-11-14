

<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title fs-5" id="exampleModalLabel"> Add Adress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/products.inc.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
        <div class="form-group">
            <label > Address</label>
            <input type="text" name="address" class="form-control radiuss" placeholder="Enter Address" required>
        </div>
        
        <div class="form-group">
            <label > Additional address Barangay/street </label>
            <input type="text" name="streetandbrgy" class="form-control radiuss" placeholder="Enter Street Name And Barangay" required>
        </div>

        <div class="form-group">
            <label > City</label>
            <input type="text" name="city" class="form-control radiuss" placeholder="Enter City" required>
        </div>
        <div class="form-group">
            <label > Postal / Zip Code</label>
            <input type="number" name="postal" class="form-control radiuss" placeholder="Enter Postal code" required>
        </div>
        <div class="form-group">
            <label > Phone Number</label>
            <input type="number" name="phone" class="form-control radiuss" placeholder="Enter Phone Number" required>
        </div>
        

        <label class="containers mt-5 ml-2"> Make Dafault Address
        <input type="checkbox" name="default" value="1">
        <span class="checkmark"></span>
        </label>

     

        
  

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" name="addaddress" class="btn btn-primary">Add Address</button>
      </div>
      </form>

    </div>
  </div>
</div>




<div class="modal fade" id="addressEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title fs-5" id="exampleModalLabel"> Edit Adress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/products.inc.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="id" id="id">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
        <div class="form-group">
            <label > Address</label>
            <input type="text" name="address" class="form-control radiuss" placeholder="Enter Address" required>
        </div>
        
        <div class="form-group">
            <label > Additional address Barangay/street </label>
            <input type="text" name="streetandbrgy" class="form-control radiuss" placeholder="Enter Street Name And Barangay" required>
        </div>

        <div class="form-group">
            <label > City</label>
            <input type="text" name="city" class="form-control radiuss" placeholder="Enter City" required>
        </div>
        <div class="form-group">
            <label > Postal / Zip Code</label>
            <input type="number" name="postal" class="form-control radiuss" placeholder="Enter Postal code" required>
        </div>
        <div class="form-group">
            <label > Phone Number</label>
            <input type="number" name="phone" class="form-control radiuss" placeholder="Enter Phone Number" required>
        </div>
        

        <label class="containers mt-5 ml-2"> Make Dafault Address
        <input type="checkbox" name="default" value="1">
        <span class="checkmark"></span>
        </label>

     

        
  

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" name="Editaddress" class="btn btn-primary">Edit Address</button>
      </div>
      </form>

    </div>
  </div>
</div>






<div class="modal fade" id="addressdeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title fs-5" id="exampleModalLabel"> Deleting Adress</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/products.inc.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"] ?>">
      <input type="hidden" name="id" id="id">
      <p> Are you sure deleting this address?</p>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" name="deleteaddress" class="btn btn-danger">Delete Address</button>
      </div>
      </form>

    </div>
  </div>
</div>

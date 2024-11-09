<!-- DELETE wish Modal -->
<div class="modal fade" id="delwishmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title fs-5" id="exampleModalLabel"> Deleting Product </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="includes/cart.inc.php" method="POST">
      <div class="modal-body">
        
        <input type="hidden" name = "userid" id="del_useridcart">
        <input type="hidden" name = "productid" id="del_productidcart">
         Are you sure deleting this Product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="submit" name="delcartbtn" class="btn btn-danger">Delete</button>
      </div>
      </form>

    </div>
  </div>
</div>
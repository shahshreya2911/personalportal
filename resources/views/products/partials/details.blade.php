<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">Product Name</label>
            <input type="text" class="form-control" id="productname"
                   name="productname" placeholder="Product Name" >
        </div>
         <div class="form-group">
            <label for="first_name">Brand Name</label>
            <input type="text" class="form-control" id="brandname"
                   name="brandname" placeholder="Brand Name" >
        </div>
        <div class="form-group">
           <label for="first_name">Attributes</label>
          <table class="table table-bordered" id="dynamicTable">  
           
            <tr>  
                <td><input type="text" name="addmore[0][name]" placeholder="Enter Attribute Name" class="form-control" /></td>  
                <td><input type="text" name="addmore[0][description]" placeholder="Enter Attribute Desc" class="form-control" /></td>  
                 <td><a href="#"
           class="btn btn-icon add"
           id="add"
         ><i class="fa fa-plus-circle"></i>
        </a></td> 
            </tr>  
        </table> 
        </div>
        <div class="form-group">
            <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="notes"
                  name="notes" placeholder="Note"></textarea>
           
        </div>
    </div>

    <div class="col-md-6">
         
     
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('app.update_details')
            </button>
        </div>
    @endif
</div>

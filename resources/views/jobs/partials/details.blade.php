 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">Job Name</label>
            <input type="text" class="form-control" id="jobname"
                   name="name" placeholder="Job Name" >
        </div>
         <div class="form-group">
            <label for="first_name">Job Number</label>
            <input type="text" class="form-control" id="jobnum"
                   name="jobnum" placeholder="Job Number" >
        </div>
        <div class="form-group">
            <label for="first_name">Job Created</label>
            <input type="text" class="form-control" id="brandname"
                   name="created" placeholder="{{ date('Y-m-d') }}" disabled >
        </div>
        <div class="form-group">
            <label for="first_name">Job Starting Date</label>
            <input type="text" class="form-control date" id="starting_date"
                   name="starting_date" placeholder="Job Starting Date"  >
        </div>
        <div class="form-group">
            <label for="first_name">Job End Date</label>
            <input type="text" class="form-control date" id="end_date"
                   name="end_date" placeholder="Job End Date" >
        </div>
        <div class="form-group">
            <label for="first_name">Job location</label>
            <input type="text" class="form-control" id="location"
                   name="location" placeholder="Job location" >
        </div>
         <div class="form-group">
            <label for="first_name">Job Description</label>
            <input type="text" class="form-control" id="description"
                   name="description" placeholder="Job Description" >
        </div>
       
        <div class="form-group">
            <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="note"
                  name="note" placeholder="Note"></textarea>
           
        </div>
        <div class="form-group">
            <label for="upload_file" class="control-label col-sm-3">Upload File</label>
            <div class="col-sm-9">
              <input class="form-control" type="file" name="upload_file" id="upload_file">
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group ">
        <div id="dropdownerror" class="invalid-feedback"></div>
      <table id="boxes-wrap">  
        <tr>
        <td>
         <div class="form-group ">
            <label for="level">Product</label>
            
                <select name="product_id[]" class="form-control parent_category" id="parentcategory_1"  onchange="getval(this);" >
                <option value="">Select Product</option>
                    @foreach ($products as $product)
                     
                             <option value="{{ $product->id }}" >{{ $product->productname }}</option>
                      
                    @endforeach
                </select>
            
        </div></td>
        <td><div class="form-group">
            <label for="level">Quantity</label>
           
                <input type="text" class="form-control proquant_1" id="proquant_1"
                       name="product_quantity[]" placeholder="Quantity" onkeyup="myFunction()" >
            
        </div></td>
        <td>
        <a href="#"
           class="btn btn-icon add"
           id="addpro"
           onclick="add_more()"
          
         ><i class="fa fa-plus-circle"></i>
        </a></td>
        </tr>
           <table>
             
              <div id="products1"></div>
          </table>
          
        <div id="dynamic"></div>
        
        </div> 
        </table>
        
       
       
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

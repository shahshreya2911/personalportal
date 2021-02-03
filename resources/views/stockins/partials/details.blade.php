 <div class="row">
    <div class="col-md-6">
       
        <div class="form-group">
            <label for="first_name">Job Created</label>
            <input type="text" class="form-control date" id="stockin_date"
                   name="stockin_date" placeholder="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" >
        </div>
       
        <div class="form-group">
            <label for="level">Stock In</label>
            
                <select name="job_id" class="form-control" id="stockin"  >
                <option value="">Select Job</option>
                    @foreach ($jobs as $job)
                     
                             <option value="{{ $job->id }}" >{{ $job->name }}</option>
                      
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="level">Reason</label>
            
                <select name="reason_id" class="form-control" id="reason"  >
                <option value="">Select Reason</option>
                    @foreach ($stockinreasons as $stockinreason)
                     
                             <option value="{{ $stockinreason->id }}" >{{ $stockinreason->name }}</option>
                      
                    @endforeach
                </select>
        </div>
         <div class="form-group">
            <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="note"
                  name="note" placeholder="Note"></textarea>
           
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

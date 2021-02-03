 <div class="row">
    <div class="col-md-6">
        <input type="hidden" name="jobid" value="{{ $jobs->id ? $jobs->id : '' }}">
           <div class="form-group">
            <label for="first_name">Job Name</label>
            <input type="text" class="form-control" id="jobname"
                   name="name" placeholder="Job Name"  value="{{ $jobs->name ? $jobs->name : '' }}">
        </div>
         <div class="form-group">
            <label for="first_name">Job Number</label>
            <input type="text" class="form-control" id="jobnum"
                   name="jobnum" placeholder="Job Number"  value="{{ $jobs->jobnum ? $jobs->jobnum : '' }}" >
        </div>
        <div class="form-group">
            <label for="first_name">Job Created</label>
            <input type="text" class="form-control" id="brandname"
                   name="created" placeholder="{{ date('Y-m-d') }}" disabled >
        </div>
        <div class="form-group">
            <label for="first_name">Job Starting Date</label>
            <input type="text" class="form-control date" id="starting_date"
                   name="starting_date" placeholder="Job Starting Date" value="{{ $jobs->starting_date ? $jobs->starting_date : '' }}"  >
        </div>
        <div class="form-group">
            <label for="first_name">Job End Date</label>
            <input type="text" class="form-control date" id="end_date"
                   name="end_date" placeholder="Job End Date" value="{{ $jobs->end_date ? $jobs->end_date : '' }}"  >
        </div>
        <div class="form-group">
            <label for="first_name">Job location</label>
            <input type="text" class="form-control" id="location"
                   name="location" placeholder="Job location" value="{{ $jobs->location ? $jobs->location : '' }}">
        </div>
         <div class="form-group">
            <label for="first_name">Job Description</label>
            <input type="text" class="form-control" id="description"
                   name="description" placeholder="Job Description" value="{{ $jobs->description ? $jobs->description : '' }}">
        </div>
       
        <div class="form-group">
            <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="note"
                  name="note" placeholder="Note">{{ $jobs->note ? $jobs->note : '' }}</textarea>
           
        </div>
        <div class="form-group">
            <label for="upload_file" class="control-label col-sm-3">Upload File</label>
            <div class="col-sm-9">
              <input class="form-control" type="file" name="upload_file" id="upload_file" >
              {{ $jobs->file ? $jobs->file : '' }}
            </div>
        </div>
        
   </div>

    <div class="col-md-6">
        <div class="form-group ">

      
       @foreach($jobwithproduct as $jobproducts)
       <div id="combo_{{ $loop->iteration }}">
       <table id="boxes-wrap"> 
       <tr>
        <td>
         <div class="form-group ">
            <label for="level">Product</label>
                <select name="product_id[]" class="form-control parent_category" id=""  onchange="getval(this);" >
                <option >Select Product</option>
                        @foreach ($products as $product)
                          @if(($product->id) == $jobproducts->productid )
                              <option value="{{ $product->id }}" selected>{{ $product->productname }}</option>
                          @else
                               <option value="{{ $product->id }}" >{{ $product->productname }}</option>
                          @endif
                        @endforeach    
                </select>
            
        </div>
        </td>
        <td><div class="form-group">
            <label for="level">Quantity</label>
           
                <input type="text" class="form-control" id="proquant_1"
                       name="product_quantity[]" placeholder="Quantity" onkeyup="myFunction()" >
            
        </div></td>
        <td>
        <a href="#"
           class="btn btn-icon add"
           id="addpro"
         ><i class="fa fa-plus-circle"></i>
        </a></td>
        </tr>
        </table>
        <table id="products_{{ $loop->iteration }}">
          @if(count($jobattributes))
                        @foreach ($jobattributes as $jobattribute)
                        @if( $jobattribute->attr_productid == $jobproducts->productid)
                       
                        
                          <tr>  
              
              <td>
                <div class="form-group">
                  <input type="hidden" name="addmore[{{$loop->index}}][attr_id]" value="{{ $jobattribute->jobattrid ? $jobattribute->jobattrid : '' }}">
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attributes]" placeholder="Attribute" value="{{ $jobattribute->jobattrid ? $jobattribute->attrname : '' }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                  <input type="hidden" name="addmore[{{$loop->index}}][product_id]" value="{{ $jobattribute->attr_productid ? $jobattribute->attr_productid : '' }}">
                   <input type="text" class="form-control" id="attrquant"
                       name="addmore[{{$loop->index}}][attr_quantity]" placeholder="Quantity" value="{{ $jobattribute->attribute_quantity }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                 
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attr_desc]" placeholder="Description" value="{{ $jobattribute->attr_desc ? $jobattribute->attr_desc : '' }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                  
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attr_remarks]" placeholder="Remarks" value="{{ $jobattribute->attr_remarks ? $jobattribute->attr_remarks : '' }}">
                </div>
              </td>
            </tr>
                        
                       @endif
                        @endforeach
              @endif  
              </table> 
             </div>   
              
        @endforeach
           
             
         
      
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

 <div class="row">
    <div class="col-md-6">
       <input type="hidden" name="stockoutid" value="{{ $stockouts->id ? $stockouts->id : '' }}">
        <div class="form-group">
            <label for="first_name">Date</label>
            <input type="text" class="form-control date" id="stockout_date"
                   name="stockout_date" placeholder="{{ date('Y-m-d') }}" value="{{  $stockouts->stockout_date ? $stockouts->stockout_date : '' }}" >
        </div>
       
        <div class="form-group">
            <label for="level">Stock Out</label>
            
                <select name="job_id" class="form-control" id="stockout"  >
                <option value="">Select Job</option>
                    @foreach ($jobs as $job)
                          @if(($job->id) == $stockouts->job_id )
                              <option value="{{ $job->id }}" selected>{{ $job->name }}</option>
                          @else
                                <option value="{{ $job->id }}" >{{ $job->name }}</option>
                          @endif
                            
                      
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="level">Reason</label>
            
                <select name="reason_id" class="form-control" id="reason"  >
                <option value="">Select Reason</option>
                    @foreach ($stockoutreasons as $stockoutreason)
                          @if(($stockoutreason->id) == $stockouts->reason_id )
                              <option value="{{ $stockoutreason->id }}" selected>{{ $stockoutreason->name }}</option>
                          @else
                             <option value="{{ $stockoutreason->id }}" >{{ $stockoutreason->name }}</option>
                          @endif
                    @endforeach
                </select>
        </div>
         <div class="form-group">
            <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="note"
                  name="note" placeholder="Note" >{{  $stockouts->notes ? $stockouts->notes : '' }}</textarea>
           
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
          @if(count($stockoutattributes))
                        @foreach ($stockoutattributes as $stockoutattribute)
                        @if( $stockoutattribute->attr_productid == $jobproducts->productid)
                       
                        
                          <tr>  
              
              <td>
                <div class="form-group">
                  <input type="hidden" name="addmore[{{$loop->index}}][attr_id]" value="{{ $stockoutattribute->attrid ? $stockoutattribute->attrid : '' }}">
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attributes]" placeholder="Attribute" value="{{ $stockoutattribute->stockoutattrid ? $stockoutattribute->attrname : '' }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                  <input type="hidden" name="addmore[{{$loop->index}}][product_id]" value="{{ $stockoutattribute->attr_productid ? $stockoutattribute->attr_productid : '' }}">
                   <input type="text" class="form-control" id="attrquant"
                       name="addmore[{{$loop->index}}][attr_quantity]" placeholder="Quantity" value="{{ $stockoutattribute->attribute_quantity }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                 
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attr_desc]" placeholder="Description" value="{{ $stockoutattribute->attr_desc ? $stockoutattribute->attr_desc : '' }}" >
                </div>
              </td>
               <td>
                <div class="form-group">
                  
                  <input type="text" class="form-control" id="location"
                         name="addmore[{{$loop->index}}][attr_remarks]" placeholder="Remarks" value="{{ $stockoutattribute->attr_remarks ? $stockoutattribute->attr_remarks : '' }}">
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

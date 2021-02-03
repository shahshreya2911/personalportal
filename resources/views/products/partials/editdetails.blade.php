
<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="productid" value="{{ $product->id ? $product->id : '' }}">
        <div class="form-group">
            <label for="first_name">Product Name</label>
            <input type="text" class="form-control" id="productname"
                   name="productname" placeholder="Product Name" value="{{ $product->productname ? $product->productname : '' }}">
        </div>
         <div class="form-group">
           <label for="first_name">Brand Name</label>
            <input type="text" class="form-control" id="brandname"
                   name="brandname" placeholder="Brand Name" value="{{  $product->brandname ? $product->brandname : '' }}">
        </div>
         <div class="form-group">
           <label for="first_name">Attributes</label>
         
           
          
         @if(count($pro_attr))
         <table class="table table-bordered" id="dynamicTable">  
             @foreach ($pro_attr as $attr)
               <tr>  
                <td><input type="text" name="addmore[{{$loop->index}}][name]" value="{{ $attr->name ? $attr->name : '' }}" placeholder="Enter Attribute Name" class="form-control" /></td>  
                <td><input type="text" name="addmore[{{$loop->index}}][description]" placeholder="Enter Attribute Desc" value="{{ $attr->description ? $attr->description : '' }}" class="form-control" /></td>  
               
                <td><a href="#"
           class="btn btn-icon add"
           id="add"
         ><i class="fa fa-plus-circle"></i>
        </a></td>  
                <td><a href="{{ route('product.attrdel', $attr->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_attr')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_attr')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fa fa-minus-circle"></i>
        </a></td>
                </tr>  
             @endforeach
              <input type="hidden" name="countadmore" value="{{ count($pro_attr) }}" id="countadmore">
               </table> 
             @else
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
             @endif
            
       </div>
        <div class="form-group">
             <label for="first_name">Note</label>
             <textarea class="form-control" rows="4" cols="50" id="notes"
                  name="notes" placeholder="Note">{{  $product->notes ? $product->notes : '' }}</textarea>
           
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

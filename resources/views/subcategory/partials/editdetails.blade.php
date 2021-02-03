 <div class="row">
    <div class="col-md-12">
       
        <div class="form-group">
            <label for="first_name">name</label>
            <input type="text" class="form-control date" id="name"
                   name="name" placeholder="Enter SubCategory" value="{{  $subcategory->name ? $subcategory->name : '' }}" >
        </div>
       <input type="hidden" name="subcat_id" value="{{  $subcategory->id ? $subcategory->id : '' }}">
        <div class="form-group">
            <label for="level">Category</label>
            
                <select name="category_id" class="form-control" id="category"  >
                <option value="">Select category</option>
                    @foreach ($category as $cat)
                              @if(($cat->id) == $subcategory->category_id )
                              <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                          @else
                             <option value="{{ $cat->id }}" >{{ $cat->name }}</option>
                             @endif
                      
                    @endforeach
                </select>
        </div>
       
         <div class="form-group">
            <label for="first_name">Description</label>
             <textarea class="form-control" rows="4" cols="50" id="description"
                  name="description" placeholder="Note">{{  $subcategory->description ? $subcategory->description : '' }}</textarea>
           
        </div>
        <div class="form-group">
            <label for="first_name">image</label>
            <input type="file" class="form-control date" id="file"
                   name="image"   >
            <img src="{{ asset('images/'.$subcategory->image) }}" height="30px" width="30px">
        </div>
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


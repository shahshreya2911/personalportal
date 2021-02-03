 <div class="row">
    <div class="col-md-12">
       
        <div class="form-group">
            <label for="first_name">name</label>
            <input type="text" class="form-control date" id="name"
                   name="name" placeholder="Enter SubCategory" >
        </div>
       
        <div class="form-group">
            <label for="level">Category</label>
            
                <select name="category_id" class="form-control" id="category"  >
                <option value="">Select category</option>
                    @foreach ($category as $cat)
                     
                             <option value="{{ $cat->id }}" >{{ $cat->name }}</option>
                      
                    @endforeach
                </select>
        </div>
       
         <div class="form-group">
            <label for="first_name">Description</label>
             <textarea class="form-control" rows="4" cols="50" id="description"
                  name="description" placeholder="Note"></textarea>
           
        </div>
        <div class="form-group">
            <label for="first_name">image</label>
            <input type="file" class="form-control date" id="file"
                   name="image"  >
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

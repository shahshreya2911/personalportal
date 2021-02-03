 <div class="row">
    <div class="col-md-12">
       
        <div class="form-group">
            <label for="name">name</label>
            <input type="hidden" name="cat_id" value="{{$category->id}}">
            <input type="text" class="form-control date" id="name"
                   name="name" placeholder="Enter Category" value="{{$category->name}}" >
        </div>
        <div class="form-group">
            <label for="acard">Action Card </label>

            <div class="input_fields_wrap">
                <a class="add_field_button btn btn-primary" onclick="add_more()" >Add More Action Card + </a>
                @foreach ($WeightCategory as $row)
                  @if($row->cat_id == $category->id)
                    <div class="form-group">
                      <input type="text" name="addmore[]" class="form-control" value="{{$row->weight}}" > 
                      <a href="#" class="remove_field" onClick="removeDiv(this)">Delete</a>
                    </div>
                  @endif
                @endforeach
            </div>
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

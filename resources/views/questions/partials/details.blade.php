<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">Sentence</label>
            <input type="text" class="form-control" id="sentence"
                   name="sentence" placeholder="Sentence" value="{{ $edit ? $question->sentence : '' }}">
        </div>
        <div class="form-group">
            <label for="level">Level</label>
        <select name=level class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        </div>
        
        <div class="form-group">
            <label for="level">Status</label>
             <div class="radio">
              <label><input type="radio" name="active" value="1">Active</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="active" value="0">InActive</label>
            </div>
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

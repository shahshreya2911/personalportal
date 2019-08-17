<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">Question</label>
            <input type="text" class="form-control" id="sentence"
                   name="sentence" placeholder="Question" value="{{ $edit ? $question->sentence : '' }}">
        </div>
        <div class="form-group">
            <div class="form-group required evidence {{ $errors->has('evidence') ? 'has-error' : '' }}">
				{!! Form::label('parent_category', 'Parent Category', array('class' => 'control-label required')) !!}*
				<div class="controls">
					{!! Form::select('parent_category', $parentCategory, null, array('id'=>'parent_category', 'class' => 'form-control', 'required' => 'required', 'placeholder' => "Select Category")) !!}
					<span class="help-block actionStatus">{{ $errors->first('parent_category', ':message') }}</span>
				</div>
			</div>
        </div>
		<div class="form-group" id='child_category_div'>
            <div class="form-group required evidence {{ $errors->has('evidence') ? 'has-error' : '' }}">
				{!! Form::label('child_category', 'Child Category', array('class' => 'control-label required')) !!}*
				<div class="controls">
					{!! Form::select('Child_category', [], null, array('id'=>'child_category', 'class' => 'form-control', 'required' => 'required')) !!}
					<span class="help-block actionStatus">{{ $errors->first('child_category', ':message') }}</span>
				</div>
			</div>
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

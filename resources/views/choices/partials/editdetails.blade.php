<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="choiceid" value="{{ $choices->id ? $choices->id : '' }}">
        <div class="form-group">
            <label for="level">Question</label>
        <select name=fk_question_id class="form-control">
            @foreach ($questions as $question)
              @if(($question->id) == $choices->fk_question_id )
            
              <option value="{{ $question->id }}" selected>{{ $question->sentence }}</option>
                @else
                   <option value="{{ $question->id }}">{{ $question->sentence }}</option>
                @endif
                
            @endforeach
        </select>
        </div>
        
        <div class="form-group">
            <label for="answer">Answer</label>
            <input type="text" class="form-control" id="answer"
                   name="answer" placeholder="Answer" value="{{ $choices->answer ? $choices->answer : '' }}">
        </div>
        <div class="form-group">
            <input type="hidden" name="is_correct" value="0">
            <label for="is_correct">Correct <input type="checkbox"  name="is_correct" value="1" {{ ($choices->is_correct=="1")? "checked" : "" }} ></label>
             
             
            
        </div>
        
        
        <div class="form-group">
            <label for="level">Status</label>
             <div class="radio">
              <label><input type="radio" name="active" value="1" {{ ($choices->active=="1")? "checked" : "" }}>Active</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="active" value="0" {{ ($choices->active=="0")? "checked" : "" }} >InActive</label>
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

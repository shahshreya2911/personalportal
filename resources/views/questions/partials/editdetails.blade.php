<style>

  #answer {
    float: left;
    width: 68%;
}
.is_correct {
    float: right;
       margin-top: 6px;
}
#correct {
   
    padding: .375rem .75rem;
    margin-left: 69%;
}
</style>

<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="questionid" value="{{ $question->id ? $question->id : '' }}">

        <div class="form-group">
            <label for="first_name">Sentence</label>
            <input type="text" class="form-control" id="sentence"
                   name="sentence" placeholder="Sentence" value="{{ $question->sentence ? $question->sentence : '' }}">
        </div>
      
        <div class="form-group">
            <label for="level">Level</label>
            
           
        <select name=level class="form-control">
            @foreach ($categories as $category)
               @if(($category->id) == $question->level )
              <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                     <option value="{{ $category->id }}" >{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        </div>
        
        <div class="form-group">
            <label for="level">Status</label>
             <div class="radio">
              <label><input type="radio" name="active" value="1"  {{ ($question->active=="1")? "checked" : "" }} >Active</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="active" value="0" {{ ($question->active=="0")? "checked" : "" }}>InActive</label>
            </div>
        </div>
       
        <div class="form-group">
         <label for="answer">Answer</label>
         <label for="correct" style="float: right;">Correct </label>
         <div class="item">
            <div id="answer_section">
            <div class="answer_radio">
            @if(count($choices))
             @foreach ($choices as $choice)
             
              <input type="hidden" name="answer[{{$loop->index}}][ansid]" value="{{ $choice->ansid ? $choice->ansid : '' }}">
              <input type="text" class="form-control" id="answer" name="answer[{{$loop->index}}][answer]" placeholder="Answer" value="{{ $choice->answer ? $choice->answer : '' }}">
              <div id="correct">  <input type="hidden" name="answer[{{$loop->index}}][is_correct]" value="0"> <input type="radio" class="is_correct" id="is_correct[{{$loop->index}}]" name="is_correct" value="1"  ansid="{{ $choice->ansid ? $choice->ansid : '' }}" {{ ($choice->is_correct=="1")? "checked" : "" }} > 
             </div>
             @endforeach
             @endif
            
             <div id="div">
               <input type="button" name="addanswer" onclick ="appendRow()" class="btn addanswer" value="Add Answer">
             </div>
            <div id="correct"> <input type="hidden" name="answer[0][is_correct]" value="0"> 
              </div> 
              
           
       </div>
           </div>
        </div>
         <!-- <div class="item">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer 2" value=""><input type="hidden" name="is_correct" value="0"><input type="radio" class="is_correct" name="is_correct" value="1">
        </div>
        <div class="item">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer 3" value=""><input type="hidden" name="is_correct" value="0"><input type="radio" class="is_correct" name="is_correct" value="1">
        </div>
        <div class="item">
            <input type="text" class="form-control" id="answer" name="answer" placeholder="Answer 4" value=""><input type="hidden" name="is_correct" value="0"><input type="radio" class="is_correct" name="is_correct" value="1">
        </div> -->
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

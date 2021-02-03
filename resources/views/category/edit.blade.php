@extends('layouts.app')

@section('page-title', 'Edit Category')
@section('page-heading', 'Edit Category')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('category') }}">Category</a>
    </li>
    <li class="breadcrumb-item active">
        Edit Category
    </li>
@stop

@section('content')

@include('partials.messages')
{!! Form::open(['route' => 'category.storeedit', 'files' => true, 'id' => 'edit-category-form' ,'method' =>'POST']) !!}
         

    <div class="card">
        <div class="card-body">
            <div class="row">
              <!--   <div class="col-md-3">
                    <h5 class="card-title">
                        Job details
                    </h5>
                    
                </div> -->
                <div class="col-md-12">
                    @include('category.partials.editdetails', ['edit' => false])
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
{!! Form::close() !!}

<br>
@stop

<script type="text/javascript">

function removeDiv(elem){
    $(elem).parent('div').remove();
}

function add_more() {

    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    
    $(wrapper).append('<div class="form-group"> <input type="text" name="addmore[]" class="form-control"> <a href="#" class="remove_field">Delete</a></div>'); //add input box
      
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
}
</script>
@section('scripts')
  
@stop
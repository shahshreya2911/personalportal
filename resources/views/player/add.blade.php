@extends('layouts.app')



@section('page-title', 'Add Player')

@section('page-heading', 'Add Player')



@section('breadcrumbs')

    <li class="breadcrumb-item">

        <a href="{{ route('player') }}"> Players</a>

    </li>

    <li class="breadcrumb-item active">

        @lang('app.create')

    </li>

@stop

<style type="text/css">

    .form-group.inline {

    display: inline-block;

}

</style>

@section('content')



@include('partials.messages')



{!! Form::open(['route' => 'player.store', 'files' => true, 'id' => 'add-player-form' ,'method' =>'POST', 'enctype'=>'multipart/form-data' ]) !!}

       



    <div class="card">

        <div class="card-body">

            <div class="row">

               <!--  <div class="col-md-1">

                    <h5 class="card-title">

                        Job details

                    </h5>

                    

                </div> -->

                <div class="col-md-12">

                    @include('player.partials.details', ['edit' => false])

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

$( document ).ready(function() {
   // alert("hi");
   getWeightCat();
});

function getWeightCat()
{   
    // parentID = $('.qparent').data('qparentid');
    catID = $("#sports").val();
    console.log('selected ID : '+catID);
    
     $.ajax({
        type: "POST",
        url: "{{ URL::to('player/get-weight-cat') }}",
        data: {'cat_id': catID, _token: '{{ csrf_token() }}'},
        success: function (data) {

            console.log(data);
            $("#weight_cat").empty();
            $("#weight_cat").append('<option value=""> Select Weight Category </option>');
            $.each(data,function(key,value){
              $("#weight_cat").append('<option value="'+key+'">'+value+'</option>');
            });
        }
    });
}

</script>
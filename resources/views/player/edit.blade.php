@extends('layouts.app')



@section('page-title', 'Edit Player')

@section('page-heading', 'Edit Player')



@section('breadcrumbs')

    <li class="breadcrumb-item">

        <a href="{{ route('player') }}">Players</a>

    </li>

    <li class="breadcrumb-item active">

        Edit Player

    </li>

@stop



@section('content')



@include('partials.messages')

{!! Form::open(['route' => 'player.storeedit', 'files' => true, 'id' => 'edit-category-form' ,'method' =>'POST']) !!}

         



    <div class="card">

        <div class="card-body">

            <div class="row">

              <!--   <div class="col-md-3">

                    <h5 class="card-title">

                        Job details

                    </h5>

                    

                </div> -->

                <div class="col-md-12">

                    @include('player.partials.editdetails', ['edit' => false])

                </div>

            </div>

        </div>

    </div>





    <div class="row">

        <div class="col-md-12">

            <button type="submit" class="btn btn-primary">

                Update

            </button>

        </div>

    </div>

{!! Form::close() !!}



<br>

@stop

@section('scripts')

<script type="text/javascript">

$( document ).ready(function() {
   // alert("hi");
   getWeightCat();
});

function getWeightCat()
{   
    // parentID = $('.qparent').data('qparentid');
    catID = $("#sports").val();
    oldWeightCat = $("#old_weight_cat").val();
    console.log('selected ID : '+catID);
    console.log('oldWeightCat ID : '+oldWeightCat);
    
     $.ajax({
        type: "POST",
        url: "{{ URL::to('player/get-weight-cat') }}",
        data: {'cat_id': catID, _token: '{{ csrf_token() }}'},
        success: function (data) {
            console.log(data);
            $("#weight_cat").empty();
            $("#weight_cat").append('<option value=""> Select Weight Category </option>');
            $.each(data,function(key,value){

                if(key == oldWeightCat){
                    $("#weight_cat").append('<option value="'+key+'" selected >'+value+'</option>');
                }else{
                    $("#weight_cat").append('<option value="'+key+'">'+value+'</option>');
                }
              
            });
        }
    });
}

</script>



  

@stop
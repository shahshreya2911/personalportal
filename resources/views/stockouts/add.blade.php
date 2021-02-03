@extends('layouts.app')

@section('page-title', 'Add StockOut')
@section('page-heading', 'Add StockOut')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('stockout') }}">StockOut</a>
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

{!! Form::open(['route' => 'stockout.store', 'files' => true, 'id' => 'stockout-form' ,'method' =>'POST', 'enctype'=>'multipart/form-data' ]) !!}
       

    <div class="card">
        <div class="card-body">
            <div class="row">
               <!--  <div class="col-md-1">
                    <h5 class="card-title">
                        Job details
                    </h5>
                    
                </div> -->
                <div class="col-md-12">
                    @include('stockouts.partials.details', ['edit' => false])
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

@section('scripts')
{!! HTML::script('assets/js/as/job.js') !!}
{!! JsValidator::formRequest('Vanguard\Http\Requests\Stockout\StockoutRequest', '#stockout-form') !!}
  <script>
  function getval(sel)
{
    //alert(sel.value);
    var $div = $('div[id^="products"]:last');
     $('#dropdownerror').css("display", "none");
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 );
    // alert(num);
     var proqunat = $('#proquant').val();
     $.ajax({
        type: "POST",
        url: "{{ URL::to('job/generate-child-category') }}",
        data: {'parent_category_id': sel.value, _token: '{{ csrf_token() }}'},
        success: function (data) {
           
            $('#products'+num).html('');
            $.each(data, function (index,text) {
               
                $('#products'+num).append('<tr><td><input type="hidden" class="form-control" name="addmore['+index+'][attr_id]" value='+index+'></input><input type="text" class="form-control" name="addmore['+index+'][attributes]" value='+text+'></input></td><td><input type="hidden" class="form-control" name="addmore['+index+'][product_id]" value='+sel.value+'></input> <input type="text" class="form-control attrquant_'+num+'" id="attrquant_'+num+'" name="addmore['+index+'][attr_quantity]" placeholder="Quantity" ></td>  <td> <input type="text" class="form-control" id="location" name="addmore['+index+'][attr_desc]" placeholder="Description" ></td><td><input type="text" class="form-control" id="location" name="addmore['+index+'][attr_remarks]" placeholder="Remarks" ></td></tr>')
               // $('#child_category').append(text);
            });
        }
    });
}

 //alert(proquantnum);
function myFunction() {
   // alert("hii");
    var $proquantdiv = $('[id^="proquant_"]:last');
    var proquantnum = parseInt( $proquantdiv.prop("id").match(/\d+/g), 10 );  
     var quantval = $("#proquant_"+proquantnum).val();
    // alert(quantval);
     $(".attrquant_"+proquantnum).val(quantval);
}

</script>
@stop
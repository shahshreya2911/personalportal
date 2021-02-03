@extends('layouts.app')



@section('page-title', 'Players')

@section('page-heading', 'Players')



@section('breadcrumbs')

    <li class="breadcrumb-item active">

       Players

    </li>

@stop



@section('content')



@include('partials.messages')



<div class="card">

    <div class="card-body">



        <form action="" method="GET" id="users-form" class="pb-2 mb-3 border-bottom-light">

            <div class="row my-3 flex-md-row flex-column-reverse">

                <div class="col-md-4 mt-md-0 mt-2">

                   

                </div>



              <div class="col-md-2 mt-2 mt-md-0"></div>

                <div class="col-md-6">

                    <a href="{{ route('player.create') }}" class="btn btn-primary btn-rounded float-right">

                        <i class="fas fa-plus mr-2"></i>

                        Add Players

                    </a>

                </div>

            </div>

        </form>
<style type="text/css">
    #user_table_wrapper{
        display: block;
    }
</style>
        <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="35%">Name</th>
                        <th width="35%">Sports</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

</div>









@stop



@section('scripts')

<script>

$(document).ready(function(){

 $('#user_table').DataTable({
    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          
          var select = $('<select><option value=""></option></select>')
              .appendTo( $(column.footer()).empty() )
              .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                  );

                  column
                      .search( val ? '^'+val+'$' : '', true, false )
                      .draw();
                 // console.log('here'+val);    
              } );

          column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
      } );
  },
  processing: true,
  serverSide: true,
  ajax: {
    url: "{{ route('player') }}",
  },
  columns: [
    {data: 'name',name: 'name'},
    {data: 'sports',name: 'sports'},
    {data: 'action',name: 'action',orderable: false}
  ],
 
 });


});



</script>

@stop


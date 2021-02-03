
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</title>
>
  <!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  -->
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">player</h3>
     <br />
     <div align="right">
     </div>
     <br />

   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="35%">First Name</th>
                <th width="35%">Last Name</th>
                <th width="30%">Action</th>
      </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>



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
    {data: 'age',name: 'age'},
    {data: 'action',name: 'action',orderable: false}
  ],
 
 });


});


</script>


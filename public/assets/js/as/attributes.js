   /*var i = 0;

  $(".add").click(function(){
    
      ++i;
      $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" loopval="'+i+'" placeholder="Enter Attribute Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][description]" placeholder="Enter Attribute Desc" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
  });
  $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
  });  
*/
 var dom = document.getElementById('countadmore');
    if(dom == null)
    {  
      var i = 0;
      onAddmore()
    }else{
      $(".add").click(function(){
  //alert("hii");
      //var i = 0;
      
      if($("#countadmore").val().length == 0){
        var i = 0;
      }else{
        var i = $("#countadmore").val() - 1;
        var countaddmoreval = parseInt($("#countadmore").val());
        var sum = countaddmoreval + 1
        $("#countadmore").val(countaddmoreval + 1);
      }  
      addmore(i);
      });
    }
    
function onAddmore(){
  $(".add").click(function(){
    
      ++i;
      $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" loopval="'+i+'" placeholder="Enter Attribute Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][description]" placeholder="Enter Attribute Desc" class="form-control" /></td><td><a href="#" class="btn btn-icon remove-tr"><i class="fa fa-minus-circle"></i></a></td></tr>');
  });
  $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
  });  
} 
   
function addmore(i){

      ++i;
      $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter Attribute Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][description]" placeholder="Enter Attribute Desc" class="form-control" /></td><td><a href="#" class="btn btn-icon remove-tr"><i class="fa fa-minus-circle"></i></a></td></tr>');
 
}
  
  $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
  });  
  
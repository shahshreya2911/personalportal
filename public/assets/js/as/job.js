 $('.date').datepicker({  
   format: 'yyyy-mm-dd'
 });
   
  

  var boxesWrap = $('#boxes-wrap');
  var boxRow = boxesWrap.children(":first");
  var boxRowTemplate = boxRow.clone();
  boxRow.find('button.remove-gas-row').remove();
  
  // nb can't use .length for inputCount as we are dynamically removing from middle of collection
  var inputCount = 1; 

  function add_more() {
     inputCount++;
       var $parentcategorydiv = $('[id^="parentcategory_"]:last');

    var parentcategorynum = parseInt( $parentcategorydiv.prop("id").match(/\d+/g), 10 );
   // alert(parentcategorynum);
    //  newRow.find('#parentcategory_'+ parentcategorynum).attr('id','parentcategory_'+inputCount);
    if ($("#parentcategory_"+parentcategorynum).val() === "") {
       $('#dropdownerror').css("display", "block");
      $('#dropdownerror').text("Please Select Product");
    //alert('Please Select Prodct')

}else{
   var newRow = boxRowTemplate.clone();
   // inputCount++;
    newRow.find('input.name').attr('placeholder', 'Input '+inputCount);
    $('#dynamic').append(newRow).attr("class", "clonedInput" +  inputCount);
    $('.clonedInput'+  inputCount).append("<div id=products" +  inputCount+"></div>");
     var $proquantdiv = $('[id^="proquant_"]:last');
    var proquantnum = parseInt( $proquantdiv.prop("id").match(/\d+/g), 10 );
      newRow.find('#proquant_'+ proquantnum).attr('id','proquant_'+inputCount);
    //  alert(proquantnum);
     // alert(inputCount);
       newRow.find('#proquant_'+ proquantnum).attr('class','proquant_'+inputCount);
    var $parentcategorydiv = $('[id^="parentcategory_"]:last');
    var parentcategorynum = parseInt( $parentcategorydiv.prop("id").match(/\d+/g), 10 );
      newRow.find('#parentcategory_'+ parentcategorynum).attr('id','parentcategory_'+inputCount);
}
   
  };  
/* var $proquantdiv = $('[id^="proquant_"]:last');
    var proquantnum = parseInt( $proquantdiv.prop("id").match(/\d+/g), 10 );  
 alert(proquantnum);
  $("#proquant_"+proquantnum).keyup(function() {
    alert("hii");
     var quantval = $("#proquant_"+proquantnum).val();
    // alert(quantval);
     $(".attrquant_"+proquantnum).val(quantval);
})*/
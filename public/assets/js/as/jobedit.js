 $('.date').datepicker({  
   format: 'yyyy-mm-dd'
 });
 //alert('hiii');  

 

  $('.add').click(function () {
    var $div = $('div[id^="combo_"]:last');
     var $productdiv = $('table[id^="products_"]:last');

  var num = parseInt( $div.prop("id").match(/\d+/g), 10 )+1;
    var pronum = parseInt( $productdiv.prop("id").match(/\d+/g), 10 );
     var klon = $div.clone().prop('id', 'combo_'+num );

     $div.after( klon );
     $('#products_'+ num-1, klon).attr('id', 'products_'+num); 
     klon.find('#products_'+ pronum).attr('id','products_'+num);
      var $proquantdiv = $('[id^="proquant_"]:last');
      var proquantnum = parseInt( $proquantdiv.prop("id").match(/\d+/g), 10 );
     // alert(proquantnum);
      klon.find('#proquant_'+ proquantnum).attr('id','proquant_'+num);
      klon.find('#proquant_'+ proquantnum).attr('class','proquant_'+num);
   
  });  
  
 

var x=1
function appendRow()
{
   var d = document.getElementById('div');
   
   	 x++;
     d.innerHTML += "<div class='row'><div class='col-md-6'><div class='form-group'><input type='text' class='input form-control' id='tst"+ x +"' name='answer' required ><input type='button' id='btSubmit"+ x +"' class='btn' value='Submit' onclick='getTextValue()' /> <input type='button' class='remove_this btn btn-danger' value='Remove Button' id='removeButton"+ x +"' /></div></div></div>";   
    $(".addanswer").attr('disabled','disabled');
   
}
jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().remove();
        x--;
        $('.addanswer').removeAttr('disabled','disabled');
});

 
    

var values = new Array();
function getTextValue() {
        values = $('.input').val();
var full_url = document.URL; // Get current url
var url_array = full_url.split('/') // Split the string into an array with / as separator
var question_id = url_array[url_array.length-1];

       if (values != '') {
            // NOW CALL THE WEB METHOD WITH THE PARAMETERS USING AJAX.
            $.ajax({
                type: 'POST',
                url: '../../choices/store',
                data: {'answer': values , 'is_correct': '0', 'fk_question_id': question_id ,'active' :'1'},
               
                success: function (response) {
                      // EMPTY THE ARRAY.
                      $("#answer_section").load(location.href + " #answer_section", "");
                    //$('#answer_section').html();
                    
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
        else { alert("Fields cannot be empty.") }
    }

$('.answer_radio input[type=radio]').click(function(){
	var full_url = document.URL; // Get current url
	var url_array = full_url.split('/') // Split the string into an array with / as separator
	var question_id = url_array[url_array.length-1];
      var is_correct = $(this).val(); 
      var myId = $(this).attr('ansid');
      // alert(myId);
       if(myId != ''){
	       	$.ajax({
	                type: 'POST',
	                url: '../../choices/storeedit',
	                data: {'choiceid': myId , 'is_correct': is_correct ,'fk_question_id': question_id},
	               
	                success: function (response) {
	                      // EMPTY THE ARRAY.
	                      $("#answer_section").load(location.href + " #answer_section", "");
	                    //$('#answer_section').html();
	                    
	                },
	                error: function (XMLHttpRequest, textStatus, errorThrown) {
	                    alert(errorThrown);
	                }
	         });
       }
})
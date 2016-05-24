$(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker" ).datepicker();
	//Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});


$(document).ready(function(){
//Datepicker Popups calender to Choose date
$(function(){
    $( "#datepicker1" ).datepicker();
	//Pass the user selected date format 
    $( "#format" ).change(function() {
      $( "#datepicker1" ).datepicker( "option", "dateFormat", $(this).val() );
    });
  });
  
});

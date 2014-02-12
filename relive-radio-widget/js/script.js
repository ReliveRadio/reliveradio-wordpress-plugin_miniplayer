 $('#YourSelectList').bind('change', function (e) { 
    if( $('#YourSelectList').val() == 241) {
      $('#OtherDiv').show();
    }
    else{
      $('#OtherDiv').hide();
    }         
  }); 
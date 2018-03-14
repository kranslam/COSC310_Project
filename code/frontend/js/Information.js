$(document).ready(function(){
  var Email=$("#Email").text;
  $(form).submit(function(event){
    if(Email==""){
      $("#Email").css("background-color","red");
      event.preventDefault();


    }
});
});

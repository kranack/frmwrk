$(document).ready(function(){

  /* Drop Log File */
  if ($("#DropLog").length > 0) {
    $("#DropLog").on('click', function(){
      $.post('/admin', {action:"dropLog"}, function(data) {
        if (data.status) {
          console.log('dropped')
        } else {
          console.log('not dropped');
        }
      }, "json");
    });
  }
});

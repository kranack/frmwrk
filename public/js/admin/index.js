$(document).ready(function(){

  /* Drop Log File */
  if ($("#DropLog").length > 0) {
    $("#DropLog").on('click', function(){
      $.post('/admin', {action:"dropLog"}, function(data) {
        if (data.status) {
          window.location.reload();
        } else {
          console.log('not dropped');
        }
      }, "json");
    });
  }
});

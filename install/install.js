$(document).ready(function() {

  var db_ports = {"mysql" : '3306', "mariadb" : '3307'};

  $("#dbPort").attr('placeholder', db_ports[$('#chooseEngine').val()]);
  /* Change db engine */
  $('#chooseEngine').on('change', function() {
    var port = db_ports[$(this).val()];
    $("#dbPort").attr('placeholder', port);
  });

  /* Add database */
  $('#addDatabase').on('click', function() {
    //var database = $('#db').html();
    //$('#databaseContainer').append(database);
  });
});

$(document).ready(function() {
  /* Set sidebar */
  $('.ui.sidebar')
  .sidebar({
    context: $('.bottom.segment')
  })
  .sidebar('attach events', '.menu .item')
  ;

  /* Listen on modules page */
  if ($("#modules_list").length > 0) {
    $(".ui.checkbox").checkbox({
        'onChange': function() {
          var label = $(this).next();
          var val = $(this).context.checked;
          var name =$(this).context.name.split("_")[0];
          $.post('/admin/modules', {module:name,status:val}, function(data) {
            if (data.status) {
              label.text('enabled');
            } else {
              label.text('disabled');
            }
          }, "json");
        }
    });
  }

  if ($("#opts_list").length > 0) {
    $(".delete").on('click', function() {
      var id = $(this).attr('id').split('_');
      var name = id[0];
      var opt = id[1];
      $.post('/admin/modules/edit', {action:'delete',module:name,option:opt}, function(data) {
        console.log(data);
      }, "json");
    });
  }
});

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

  /* Listen on module infos page */
  if ($("#opts_list").length > 0) {

    /* Delete the option */
    $(".delete").on('click', function() {
      var id = $(this).attr('id').split('_');
      var name = id[0];
      var opt = id[1];
      var row = $(this).parent('td').parent('tr');
      $.post('/admin/modules/edit', {action:'delete',module:name,option:opt}, function(data) {
        row.transition('scale');
      }, "json");
    });

    $('.editable').on('dblclick', function() {
      if ($(this).find('input').length > 0) {
        return false;
      }
      var cell = $(this);
      var row = cell.parent('tr');
      var value = cell.html().trim();
      /* Copy input and give value */
      var div = $("#input .input").clone();
      div.attr('id', 'inputContainer');
      div.find('input').val(value).attr('id', 'inputTemp');
      /* Add input to cell */
      cell.html(div);

      /* Listen on the input */
      $('#inputTemp').blur(function() {
        var val = $('#inputTemp').val();
        cell.remove('#inputTemp');
        cell.html(val);
        var name = $('table').attr('data-module');
        var t = row.find('td');
        $.post('/admin/modules/edit', {action:'edit',module:name,option:t[1],value:t[2]}, function(data) {
          //row.transition('scale');
          console.log(data);
        }, "json");
      });
    });

  }
});

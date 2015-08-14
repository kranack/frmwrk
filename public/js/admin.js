$(document).ready(function() {
  /* GLOBAL OPTS */
  var POOL_CELL = null;


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

    /* Edit the option */
    $('.editable').on('dblclick', function() {
      if ($(this).find('input').length > 0) {
        return false;
      }
      if (POOL_CELL === null) {
        POOL_CELL = $(this);
      }
      console.log(POOL_CELL);
      var row = POOL_CELL.parent('tr');
      var value = POOL_CELL.html().trim();
      /* Copy input and give value */
      var div = $("#input .input").clone();
      div.attr('id', 'inputContainer');
      div.find('input').val(value).attr('id', 'inputTemp');
      /* Add input to cell */
      POOL_CELL.html(div);

      /* Listen on the input */
      $('#inputTemp').on('click', function(event) {
        event.stopPropagation();
      });
      /* Listen on html for sending data */
      $('html').on('click', function() {
        if ($("#inputTemp").length === 0) {
          return false;
        }
        if ($("#inputTemp").val().trim() === "") {
          return false;
        }

        sendOptionData(row);
      });
      /* Listen on enter key for sending data */
      $('#inputTemp').keypress(function(e) {
        if (e.which === 13) {
          if ($("#inputTemp").length === 0) {
            return false;
          }
          if ($("#inputTemp").val().trim() === "") {
            return false;
          }

          sendOptionData(row);
        }
      });
    });

    /* Add an option */
    $('#addOpt').on('click', function() {
      /*var row = $('#row').clone();
      row.removeClass('hidden');
      $("#opts_list table").append(row);*/
    });
  }


  /* FUNCTIONS DECLARATION */

  function sendOptionData(row) {
    var input_value = $('#inputTemp').val().trim();
    POOL_CELL.remove('#inputTemp');
    POOL_CELL.html(input_value);
    var name = $('table').attr('data-module');
    var t = row.find('td');
    var k = $(t[0]).find('a').attr('id').split('_')[1];
    var opt = $(t[1]).text().trim();
    var val = $(t[2]).text().trim();

    /* Check if values are empty before sending */
    if (opt === "" ||
      val === "") {
        return false;
      }

      $.post('/admin/modules/edit', {action:"edit",module:name,key:k,option:opt,value:val}, function(data) {
        if (data.status) {
          /* Change the name of the id with the new key
          and reset cell value */
          $(t[0]).find('a').attr('id', name+'_'+opt);
          POOL_CELL = null;
        }
      }, "json");
  }

});

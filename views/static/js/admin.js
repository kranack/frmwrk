$(document).ready(function() {
  /* Set sidebar */
  $('.ui.sidebar')
  .sidebar({
    context: $('.bottom.segment')
  })
  .sidebar('attach events', '.menu .item')
  ;
});

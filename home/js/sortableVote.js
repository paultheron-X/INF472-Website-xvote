$(function() {
    var $sortable = $("#sortable").sortable({
      update: function(event, ui) {
        var $data = $(this).sortable('toArray');
        $("#position").val(JSON.stringify($data));
      }
    });
    $sortable.disableSelection();
    $("#position").val(JSON.stringify($sortable.sortable("toArray")));
  });
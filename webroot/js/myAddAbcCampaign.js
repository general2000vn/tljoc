$('document').ready(function () {
    $(':checkbox[name=selectAll]').click (function () {
        //alert('clicked on Checkbox');
        $(":checkbox[class='custom-control-input staff']").prop('checked', this.checked);
      });
});


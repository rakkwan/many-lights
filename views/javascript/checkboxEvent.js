$('#businessHours :checkbox').change(function() {
    let day;
    // this will contain a reference to the checkbox
    if ($(this).is(':checked')) {
        console.log($(this).val() + ' is now checked');
        day = $(this).val();
        $("#" + day).show();
    }
    else {
        console.log($(this).val() + ' is now unchecked');
        day = $(this).val();
        $("#" + day).hide();
    }
});
// Toggle event for showing time
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

// Show time when going back
var boxes = $('.myCheck:checked');
boxes.each(function (i, checkbox) {
    var day = document.getElementById(checkbox.value);
    console.log(day);
    $(day).show();
});

// Toggle event for showing therapist information
$('#service').change(function () {
    if ($(this).val() == 'Therapy') {
        $('#therapistInfo').show();
        console.log($(this).val() + ' is selected');
    }
    else {
        $('#therapistInfo').hide();
        console.log($(this).val() + ' is selected');
    }
});



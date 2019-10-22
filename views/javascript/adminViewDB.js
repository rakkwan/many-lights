// Simple Pagination Enabled
$(document).ready(function () {
    $('#dtHorizontalVerticalExample').DataTable({
        "pagingType": "simple", // "simple" option for 'Previous' and 'Next' buttons only
        "scrollX": true,
        "scrollY": 200,
    });
    $('.dataTables_length').addClass('bs-select');
});

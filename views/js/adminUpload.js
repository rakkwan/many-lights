/**
 * Robert Hill
 * 11/22/19
 * adminUpload.js
 * This is the JavaScript file for DOM munipulation of the adminDashboard.html file to do
 * bulk resource file upload
 */

/**
 * Function to run upon html is loaded.
 * For instance of bootstrap input form
 * enables Drag & Drop
 */
$(document).ready(function () {
    bsCustomFileInput.init();
    fileUpload();
    getUpload();
});

captureFile();

/**
 * Function to capture file from HTML element with id of #excelUpload
 */
function captureFile() {
    document.getElementById('excelUpload').onchange = uploading;
}

/**
 * Function to upload the file content
 * @param event listener action
 */
function uploading(event) {
    // Uploading text spinner
    document.getElementById("uploading").innerHTML = "<div class=\"spinner-grow text-secondary\" role=\"status\">\n" +
        "  <span class=\"sr-only\">Loading...</span>\n" +
        "</div>";

    // create a FormData Object
    var formData = new FormData();

    // get selected files from input
    if ($(this).prop('files').length > 0) {
        file = $(this).prop('files')[0];
        formData.append("excelUpload", file);
    }

    // run ajax to upload a file
    ajaxCall(formData);
    confirmUpload();
}

/**
 * Function to prompt user
 * that the information was uploaded
 */
function confirmUpload() {
    jQuery.noConflict();
    //Confimation For user
    $("#confirmEditModalSuccess").modal("show");
    $("#confirmEdit").text("Resources from XLXS has been uploaded\n" +
        "in to the OneStop WA Database!");
}

/**
 * Function to execute the
 * AJAX on an INPUT file
 * @param input object that represents the file to send to the DB
 */
function ajaxCall(input) {
    //jQuery AJAX call to PHP script
    $.ajax({
        url: "./model/ajax/posts/uploadXL_ajax.php",
        type: "POST",
        data: input,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            document.getElementById("uploading").innerHTML = "<h4 id=\"uploading\">" +
                "Excel <i class=\"fas fa-file-excel fa-3x\"></i> Upload</h4>";
        }
    });
}

/**
 * Function Admin can upload file to the Server directory.
 * Not the DB
 */
function fileUpload() {
    $("#but_upload").click(function() {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: './model/ajax/posts/fileUpload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    alert('file uploaded');
                }
                else{
                    alert('file not uploaded');
                }
                console.log(response);
            },
        });
    });
}

/**
 * Function Admin can Search files in the Server Upload directory.
 * Not the DB
 */
function getUpload() {
    $.get( "./model/ajax/gets/getUploadedFiles_ajax.php", function( data ) {
        console.log(data);
    });

    $('basicAutoSelect').autoComplete({
        resolverSettings: {
            url: "./model/ajax/gets/getUploadedFiles_ajax.php"
        }
    });
}
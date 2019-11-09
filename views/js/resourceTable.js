/**
 * Robert Hill
 * 11/1/19
 * resourceTable.js
 * This is the JavaScript file has functions for the datatables, modal info,
 * and admin modal buttons for pending and declining resources status
 */

//Listing Data Table
$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('#dtBasicExample1').DataTable();
    $('.dataTables_length').addClass('bs-select');
    downloadResourcePdf();
});

//Modal information
$('#dtBasicExample').on('click', 'tr', function () {

    //get value of resource from the datatable
    let $res = $(this).attr("title");

    //gets the info for the modal
    console.log($res);
    completeModal($res);

    $(this).attr("data-toggle", "modal");
    $(this).attr("data-target", "#centralModalSuccess");

});

let downloadId;

//Modal information
$('#dtBasicExample1').on('click', 'tr', function () {

    //get value of resource from the datatable
    let $dataRowId = $(this).attr("value");

    //gets the info for the modal
    console.log($dataRowId);
    downloadId = $dataRowId;
    completeModal($dataRowId);

    $(this).attr("data-toggle", "modal");
    $(this).attr("data-target", "#centralModalSuccess1");

});


function downloadResourcePdf() {

    $("#downloadPdf").click(function () {

        $.post("model/ajax/gets/getResourceDatatable_ajax.php", {
                statusID: downloadId
            },
            function (data, status) {
                var info = JSON.parse(data);
                console.log(info);
            });
        console.log(downloadId);
        // location.href =

    });

}

//Accept Button function for the Status of selected resource
$('#approve').click(function () {
    let $res = $('#here').text();
    acceptedStatus($res);
});

//Decline Button function for the Status of selected resource
$('#decline').click(function () {
    let $res = $('#here').text();
    declinedStatus($res);
});

//Edit Button Function for Admin listing
$('#edit').click(function () {
    let $res = $('#here').text();
    completeModal($res);
});

//Action execute the Admin Edit
$("a[lang='fEdit']").click(function () {
    var ready = confirm("Ready to EDIT the OneStop WA DB?");
    if (ready == true) {
        AdminEditInfo();
    } else {
        return;
    }
});

//refresh page after edit is complete
$("#editedListing").click(function () {
    location.href = self['location'];
})

/**
 * Parses the info returned from API into the modal
 * @param data json object
 */
function completeModal($id) {

    //ajax post call to php script
    $.post("model/ajax/gets/getResourceDatatable_ajax.php", {
            statusID: $id
        },
        function (data, status) {
            var info = JSON.parse(data);

            if (info) {
                //Listing Modal
                //First Row of form
                $('#office').text(info.office);
                $("#Resource_ServiceType").text(info.Resource_ServiceType);
                $('#website').text(info.website);
                $('#speciality').text(info.theraFname + " " + info.theraLname);

                //Second Row of Modal
                $('#officeEmail').text(info.officeEmail);

                $('#officePhone').text(info.officePhone);

                //Third Row of Modal
                $('#address').text(info.address);
                $('#city').text(info.city);
                $('#state').text(info.state);
                $('#zip').text(info.zip);

                //Fourth Row of Modal
                $('#theraGender').text(info.theraGender);

                //Fifth Row of Modal
                $('#interpreter').text(info.interpreter);

                //Referral Row
                $('#Referral_fname').text(info.Referral_fname + " " + info.Referral_lname);
                $("#Referral_email").text(info.Referral_email);
                $("#Referral_phone").text(info.Referral_phone);
                $("#insurance").text(info.insurance);
                $("#fees").text(info.insurance);

                //admin Row
                $('#here').text(info.resourceID);

                //Edit Modal
                //First Column of Resource info placeholders
                $("#goldType").text(info.Resource_ServiceType);
                $("#goldName").text(info.office);
                $("#goldWeb").text(info.website);
                $("#goldAdd").text(info.address);
                $("#orCity").text(info.city);
                $("#orState").text(info.state);
                $("#goldZip").text(info.zip);
                // $("#goldCount").text(info.); //Counties
                // $("#goldCred").text(info.); //Credentials
                $("#goldIns").text(info.insurance);
                $("#goldFees").text(info.insurance); //Payments

                //Second Column of Resource info Placeholders
                $("#orCont").text(info.theraFname + " " + info.theraLname);
                $("#orEmail").text(info.officeEmail);
                $("#orPhone").text(info.officePhone);
                $("#orGen").text(info.theraGender);
                // $("#orAges").text(info.); //ages seen
                $("#orInt").text(info.interpreter);

                //Referral Info Placholders
                $("#refName").text(info.Referral_fname + " " + info.Referral_lname);
                $("#refEmail").text(info.Referral_email);
                $("#refPhone").text(info.Referral_phone);

            }
        });
}

/**
 * Function to for API call to Edit in DB
 * @constructor
 */
function AdminEditInfo() {
    //Resource Values
    let resType = $("#goldForm-type").val() ? $("#goldForm-type").val() : $("#goldType").text();
    let resName = $("#goldForm-name").val() ? $("#goldForm-name").val() : $("#goldName").text();
    let resWeb = $("#goldForm-website").val() ? $("#goldForm-website").val() : $("#goldWeb").text();
    let resCert = $("#goldForm-cert").val() ? $("#goldForm-cert").val() : $("#goldCred").text();
    let resIns = $("#goldForm-ins").val() ? $("#goldForm-ins").val() : $("#goldIns").text();
    let resFee = $("#goldForm-fees").val() ? $("#goldForm-fees").val() : $("#goldFees").text();
    let resAdd = $("#goldForm-address").val() ? $("#goldForm-address").val() : $("#goldAdd").text();
    let resCity = $("#goldForm-city").val() ? $("#goldForm-city").val() : $("#orCity").text();

    //Resources Values
    let resPoc = $("#orangeForm-poc").val() ? $("#orangeForm-poc").val() : $("#orCont").text();
    let resPocL = $("#orangeForm-pocL").val() ? $("#orangeForm-pocL").val() : $("#orContL").text();
    let resEmail = $("#orangeForm-email").val() ? $("#orangeForm-email").val() : $("#orEmail").text();
    let resPhone = $("#orangeForm-phone").val() ? $("#orangeForm-phone").val() : $("#orPhone").text();
    let resGender = $("#orangeForm-gender").val() ? $("#orangeForm-gender").val() : $("#orGen").text();
    let resAges = $("#orangeForm-ages").val() ? $("#orangeForm-ages").val() : "Need Ages";
    let resLang = $("#orangeForm-lang").val() ? $("#orangeForm-lang").val() : $("#orInt").text();
    let resSt = $("#goldForm-state").val() ? $("#goldForm-state").val() : $("#orState").text();
    let resZip = $("#goldForm-zip").val() ? $("#goldForm-zip").val() : $("#goldZip").text();
    let resCou = $("#goldForm-County").val() ? $("#goldForm-County").val() : $("#goldCount").text();

    //Reference Values
    let refName = $("#greyForm-name").val() ? $("#greyForm-name").val() : $("#refName").text();
    let refNameL = $("#greyForm-nameL").val() ? $("#greyForm-nameL").val() : $("#refNameL").text();
    let refEmail = $("#greyForm-email").val() ? $("#greyForm-email").val() : $("#refEmail").text();
    let refPhone = $("#greyForm-phone").val() ? $("#greyForm-phone").val() : $("#refPhone").text();

    // //Open Hours Values
    // let resOsun = $("#goldForm-sun").val() ? $("#goldForm-sun").val(): ;
    // let resOmon = $("#goldForm-mon").val() ? $("#goldForm-mon").val(): ;
    // let resOtues = $("#goldForm-tues").val() ? $("#goldForm-tues").val(): ;
    // let resOwed = $("#goldForm-wed").val() ? $("#goldForm-wed").val(): ;
    // let resOthurs = $("#goldForm-thurs").val() ? $("#goldForm-thurs").val(): ;
    // let resOfri = $("#goldForm-fri").val() ? $("#goldForm-fri").val(): ;
    // let resOsat = $("#goldForm-sat").val() ? $("#goldForm-sat").val(): ;
    //
    // //Close Hours Values
    // let resEsun = $("#goldForm-sunEnd").val() ? $("#goldForm-sunEnd").val(): ;
    // let resEmon = $("#goldForm-monEnd").val() ? $("#goldForm-monEnd").val(): ;
    // let resEtue = $("#goldForm-tuesEnd").val() ? $("#goldForm-tuesEnd").val(): ;
    // let resEwed = $("#goldForm-wedEnd").val() ? $("#goldForm-wedEnd").val(): ;
    // let resEthur = $("#goldForm-thursEnd").val() ? $("#goldForm-thursEnd").val(): ;
    // let resEfri = $("#goldForm-friEnd").val() ? $("#goldForm-friEnd").val(): ;
    // let resEsat = $("#goldForm-satEnd").val() ? $("#goldForm-satEnd").val(): ;

    //Key for the resource
    let resKey = $("#here").text();

    //Bind vars to Post
    $.post("model/ajax/puts/updateResInfo_ajax.php",
        //Post Var bind
        {
            resKey: resKey,
            resType: resType,
            resName: resName,
            resWeb: resWeb,
            resCert: resCert,
            resIns: resIns,
            resFee: resFee,
            resAdd: resAdd,
            resCity: resCity,
            resPoc: resPoc,
            resPocL: resPocL,
            resEmail: resEmail,
            resPhone: resPhone,
            resGender: resGender,
            resAges: resAges,
            resLang: resLang,
            resSt: resSt,
            resZip: resZip,
            resCou: resCou,
            refName: refName,
            refNameL: refNameL,
            refEmail: refEmail,
            refPhone: refPhone
            // resOsun : resOsun,
            // resOmon : resOmon,
            // resOtues : resOtues,
            // resOwed : resOwed,
            // resOthurs : resOthurs,
            // resOfri : resOfri,
            // resOsat : resOsat,
            // resEsun : resEsun,
            // resEmon : resEmon,
            // resEtue : resEtue,
            // resEwed : resEwed,
            // resEthur : resEthur,
            // resEfri : resEfri,
            // resEsat : resEsat
        },
        function (data, status) {
            //updated resource info
            if (data) {
                var info = JSON.parse(data);
                jQuery.noConflict();
                //Confimation For user
                $("#confirmEditModalSuccess").modal("show");
                $("#confirmEdit").text("The Resource, recommendation, and " +
                    "Hours of Service for \n " + resName + " has been updated\n" +
                    "in the OneStop WA Database!");

                console.log(status);
            } else {
                alert("There was a problem updating your selected information");
                console.log(data);
                console.log(status);
            }

        })
}
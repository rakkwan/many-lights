/**
 * Robert Hill
 * 11/1/19
 * resourceTable.js
 * This is the JavaScript file has functions for the datatables, modal info,
 * and admin modal buttons for pending and declining resources status
 */

//Listing Data Table
$(document).ready(function () {
    $('#dtBasicExample').DataTable({
        "scrollX": true
    });
    $('#dtBasicExample1').DataTable({
        "scrollX": true
    });
    $('.dataTables_length').addClass('bs-select');


//Modal information
    $('#dtBasicExample1').on('click', 'tr', function () {

        //get value of resource from the datatable
        let $dataRowId = $(this).attr("data-title");

        //gets the info for the modal
        console.log($dataRowId);
        downloadId = $dataRowId;
        let source = completeModal($dataRowId);


        $(this).attr("data-toggle", "modal");
        $(this).attr("data-target", "#centralModalSuccess1");

    });

    downloadResourcePdf();

    $("#disclaimerButton").css("display", "none");

    $("#disclaimerButton").click();

    //declined
    $("#declineDisclaimer").on("click", function () {
        //reroute home
        window.location.href = "../oneStopWa";
    });

    $("#closeDisclaimer").on("click", function () {
        //reroute home
        window.location.href = "../oneStopWa";
    });

    $("#approveDisclaimer").on("click", function () {

        //send Ajax to save session
        console.log("Saved approval");

        $.ajax({
            type: "POST",
            url: "model/ajax/puts/saveDisclaimer.php",
            data: {approve: "yes"},
            success: function (func) {
                // Do what you want to do when the session has been updated
                console.log(func);
            }
        });

        // $.post("model/ajax/puts/saveDisclaimer.php", {name: "John", approve: "yes"});
        console.log("sent approval");


    });
});

//Modal information
$('#dtBasicExample').on('click', 'tr', function () {

    //get value of resource from the datatable
    let $res = $(this).attr("data-title");

    //gets the info for the modal
    console.log($res);
    completeModal($res);

    $(this).attr("data-toggle", "modal");
    $(this).attr("data-target", "#centralModalSuccess");

});

// Disclaimer Overlay JS
/* Open */
function openNav() {
    console.log("load");
    document.getElementById("disclaimer").style.display = "block";
    $("#disclaimer").css("background-color", "yellow");
}

/* Close */
function closeNav() {
    document.getElementById("disclaimer").style.display = "none";
}

let downloadId;


/**
 * Create a cookie for the information of the resources to be transferee to MPDF download
 * @param info
 */
function createCookies(info) {

    let providerName = info.theraFname + " " + info.theraLname;
    let providerGender = (info.theraGender === 0) ? "F" : "M";
    let county = info.countyOne != null ? info.countyOne : "n/a" + ", ";
    let address = info.address + " " + info.city + ", " + info.state + " " + info.zip;

    createCookie("age", info.age, 1);
    createCookie("resource", info.Resource_ServiceType, 1);
    createCookie("office", info.office, 1);
    createCookie("providerName", providerName, 1);
    createCookie("website", info.website, 1);
    createCookie("officeEmail", info.officeEmail, 1);
    createCookie("officePhone", info.officePhone, 1);
    createCookie("county", county, 1);
    createCookie("providerGender", providerGender, 1);
    createCookie("address", address, 1);
    //ages seen m
    // createCookie("agesSeen", info.agesSeen, 1);
    //credentials
    // createCookie("credentials", info.credentials, 1);
    createCookie("interpreter", info.interpreter, 1);
    createCookie("insurance", info.insurance, 1);
    createCookie("fee", info.fee, 1);

    createCookie("", address, "1");
}

/**
 * Download the resource information as PDF
 */
function downloadResourcePdf() {

    let refresh = false;

    $("#downloadPdf").on("click", function (event) {

        // event.preventDefault();


        console.log(this);
        refresh = true;
        console.log(window.location.href);

        $.post("model/ajax/gets/getResourceDatatable_ajax.php", {
                statusID: downloadId
            },
            function (data) {
                let info = JSON.parse(data);
                console.log(info);

                $.post("model/ajax/puts/downloadPdf.php", {
                    myData: info
                }, function (data) {

                    console.log(data);
                    let url = "https://coderlite.greenriverdev.com/IT355/oneStopWa/download";
                    window.location.replace(url);
                    // $.redirect('demo.php', {'arg1': 'value1', 'arg2': 'value2'});
                });

                console.log(info);


                createCookies(info);

                // createCookie("refresh", refresh, "1");
            });


        refresh = false;

    });

}

let redirectMe = function (url, method) {
    $('<form>', {
        method: method,
        action: url
    }).submit();
};

// Function to create the cookie
function createCookie(name, value, days) {
    let expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 1000 * 25));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}

//Accept Button function for the Status of selected resource
$('#approve').click(function () {
    let $res = $('#here').text();
    acceptedStatus($res);
    location.href = self['location'];
});

//Decline Button function for the Status of selected resource
$('#decline').click(function () {
    let $res = $('#here').text();
    declinedStatus($res);
    location.href = self['location'];
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
});

/**
 * Parses the info returned from API into the modal
 * @param data json object
 */
function completeModal($id) {
    let infor;
    //ajax post call to php script
    infor = $.post("model/ajax/gets/getResourceDatatable_ajax.php", {
            statusID: $id,
            infor: null
        },
        function (data, status, infor) {

            var info = JSON.parse(data);
            if (info) {

                console.log("HERE" + info);

                infor = info;

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
                $("#orCont").text(info.theraFname);
                $("#orEmail").text(info.officeEmail);
                $("#orPhone").text(info.officePhone);
                $("#orGen").text(info.theraGender);
                // $("#orAges").text(info.); //ages seen
                $("#orInt").text(info.interpreter);
                $("#orContL").text(info.theraLname);

                //Referral Info Placholders
                $("#refName").text(info.Referral_fname + " " + info.Referral_lname);
                $("#refEmail").text(info.Referral_email);
                $("#refPhone").text(info.Referral_phone);


            }

            return infor;
        });

    console.log("INFO:" + infor.theraLname);
    console.log("INFO:" + infor.theraFname);

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
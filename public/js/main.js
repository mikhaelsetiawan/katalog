$(document).ready(function () {
});

$(document).mouseup(function (e)
{
    var container = $(".popup-box");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $(".popup-overlay").fadeOut();
    }

    var container = $(".popup-box-report");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $(".popup-overlay-report").fadeOut();
    }
});

function openPopup(id)
{
    $(".popup-box").hide();
    if (typeof id === "undefined" || id === null) {
        $(".popup-overlay").fadeIn();
        $(".popup-box").fadeIn();
    }else{
        $(".popup-overlay").fadeIn();
        $("#"+id).fadeIn();
    }
}

function openPopupReport(id)
{
    $(".popup-box-report").hide();
    if (typeof id === "undefined" || id === null) {
        $(".popup-overlay-report").fadeIn();
        $(".popup-box-report").fadeIn();
    }else{
        $(".popup-overlay-report").fadeIn();
        $("#"+id).fadeIn();
    }
}
function closePopup()
{
    $(".popup-overlay").fadeOut();
    $(".popup-box").fadeOut();
}
function closePopupReport()
{
    $(".popup-overlay-report").fadeOut();
    $(".popup-box-report").fadeOut();
}

function reportThis(target_type,target_id)
{
    $("#report_target_type").val(target_type);
    $("#report_target_id").val(target_id);
	openPopupReport("popup-report-this");
}

function showPopupReportPleasewait()
{
    $("#popup-report-this .popup-buttons .btn-group").hide();
    $("#popup-report-this .popup-buttons-pleasewait").show();
}

function closePopupReportPleasewait()
{
    $("#popup-report-this .popup-buttons .btn-group").hide();
    $("#popup-report-this .popup-buttons-pleasewait").show();
}

function submitReport()
{
    showPopupReportPleasewait();
    $.post(urlBase+"/report/submitReport",
        {
            '_token':$("#report_token").val(),
            'reportcat_id':$("#reportcat_id").val(),
            'report_target_type':$("#report_target_type").val(),
            'report_target_id':$("#report_target_id").val(),
            'report_content':$("#report_content").val(),
        }
        ,function(data)
    {
        if(data == 1)
        {
            $("#popup-report-result #popup-report-content").html("Report submited.");
        }else{
            $("#popup-report-result #popup-report-content").html("Oops, something is wrong. Please try again later.");
        }
        openPopupReport('popup-report-result');
        closePopupReportPleasewait();
    });
}
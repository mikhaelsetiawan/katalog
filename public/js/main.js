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
function closePopup()
{
    $(".popup-overlay").fadeOut();
    $(".popup-box").fadeOut();
}
$(function(){
    $("#load-videos").click();
})

$("#load-videos").click(function() {
    var thisBTN = $(this);
    var thisOffs = Number($(thisBTN).attr("data-page"));
    var thisResultList = $("#video-list")
    var thisFormTarget = $(thisBTN).attr("data-target");
    var param = $("#page-param").html().trim();

    $.ajax({
        method: "POST",
        url: thisFormTarget,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            page: thisOffs,
            param: param
        },
        dataType: "json",
        beforeSend: function() {
            startLoader(thisBTN, "Loading");
        },
        complete: function() {
            stopLoader(thisBTN);
        },
        error: function() {
//             makeAlert("An error was encountered", "danger");
        },
        statusCode: {
            419: function() {
                location.reload();
            },
        },
        success: function(response) {
            if (response.next) {
                $(thisBTN).attr("data-page", response.next);
            }
            if (response.list) {
                handleVideoCard(response.list, thisResultList);
            }else{
                //
            }
        },
    });
});

function handleVideoCard(elems, target){
    for (var i in elems) {
        var thisElem = elems[i];
        var markup = $(".aj-template .video-card").clone(true);

        $(markup).removeClass("template");
        $(markup).find(".title").html(thisElem.tt); 
        $(markup).find(".description").html(thisElem.ds); 
        $(markup).find(".video-preview").attr("src", thisElem.th); 
        $(markup).find(".video-link").attr("href", thisElem.url);
        $(target).prepend(markup);
    }
}

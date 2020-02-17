$(".simple_ajaxform").on("submit", function(e) {
    e.preventDefault();

    var thisForm = $(this)
    var thisFormID = $(thisForm).attr("id");
    var thisFormTarget = $(thisForm).attr("action");

    var params = "_token=" + $("meta[name='csrf-token']").attr("content");
    $("#" + thisFormID + " .aj-f").each(function() {
        var thisName = $(this).attr("name");
        var thisVal = encodeURIComponent($(this).val());
        params += "&" + thisName + "=" + thisVal;
    });

    $.ajax({
        method: "POST",
        url: thisFormTarget,
        data: params,
        dataType: "JSON",
        beforeSend: function() {
            startLoader(thisForm, "Processing form. Please wait");
        },
        complete: function() {
            stopLoader(thisForm);
        },
        error: function() {
            makeAlert("There was an error with your request", "danger");
        },
        success: function(response) {
            if (response.e) {
                makeAlert(response.e, "danger");
            }

            if (response.s) {
                makeAlert(response.s, "success");
            }
        },
    });
});

$(".full_ajform").on("submit", function(e) {
    e.preventDefault();

    var thisForm = $(this)[0]
    var thisFormTarget = $(thisForm).attr("action");

    var formData = new FormData(thisForm);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    $.ajax({
        method: "POST",
        url: thisFormTarget,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        beforeSend: function() {
            startLoader(thisForm, "Processing form. Please wait");
        },
        complete: function() {
            stopLoader(thisForm);
        },
        error: function() {
            makeAlert("There was an error with your request", "danger");
        },
        success: function(response) {
            if (response.e) {
                makeAlert(response.e, "danger");
            }

            if (response.s) {
                makeAlert(response.s, "success");
                thisForm.reset();
            }
        },
    });
});

$(".complex_ajaxform").on("submit", function(e) {
    e.preventDefault();

    var allSubs = [];
    var thisForm = $(this);
    var thisFormID = $(thisForm).attr("id");
    var thisFormTarget = $(thisForm).attr("action");
    var thisSubs = $(thisForm).attr("data-subs");

    $(".current-sub").removeClass("current-sub");
    $("#" + thisFormID + " ." + thisSubs).each(function() {
        var thisSub = $(this);
        $(thisSub).addClass("current-sub");
        var thisData = {};

        $(".current-sub .aj-f").each(function() {
            var thisName = $(this).attr("name");
            var thisVal = JSON.stringify($(this).val());

            eval("thisData." + thisName + " = " + thisVal);
        });
        $(".current-sub").removeClass("current-sub");
        allSubs.push(thisData);
    });

    $.ajax({
        method: "POST",
        url: thisFormTarget,
        data: {
            _token: $("meta[name='csrf-token']").attr("content"),
            data: allSubs
        },
        dataType: "JSON",
        beforeSend: function() {
            startLoader(thisForm, "Processing your request");
        },
        complete: function() {
            stopLoader(thisForm);
        },
        error: function() {
            makeAlert("There was an error with your request", "danger");
        },
        success: function(response) {
            if (response.e) {
                makeAlert(response.e, "danger");
            }

            if (response.s) {
                makeAlert(response.s, "success");
            }
        },
    });
});

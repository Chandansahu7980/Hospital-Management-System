
if ($(window).width() < 426) {
    $("#bar-check").prop('checked', true);
    toggleSidebar();
}

function toggleSidebar() {
    if ($("#bar-check").prop("checked")) {
        console.log("checked form fun");
        $(".left-container .head i").css('transform', 'rotate(180deg)');
        $("#hms-heading").hide();
        $(".list-item").hide();
    } else {
        console.log("unchecked from fun");
        $(".left-container .head i").css('transform', 'rotate(0deg)');
        $("#hms-heading").show();
        $(".list-item").show();
    }
}


$("#profile-btn").click(function () {
    $(".rgt-cont").hide();
    $("#profile-div").show();
});

$("#bookApnt-btn").click(function () {
    $(".rgt-cont").hide();
    $("#book-apnt").show();
});

$("#apntHtry-btn").click(function () {
    $(".rgt-cont").hide();
    $("#apnt-htry").show();
});

$("#medical_htry-btn").click(function () {
    $(".rgt-cont").hide();
    $("#mdl-htry").show();
});

$("#query-btn").click(function () {
    $(".rgt-cont").hide();
    $("#queries").show();
});

$("#log-out-btn").click(function () {
    $(".rgt-cont").hide();
    $("#log-out").show();
});

$(".edit-dp").click(function () {
    $(".mid-cont").fadeIn();
});

$(".close-mid").click(function () {
    $(".mid-cont").fadeOut();
});

$(".raise_query").click(function () {
    $(".query_raise_form").fadeIn();
});

$(".close_query_form").click(function () {
    $(".query_raise_form").fadeOut();
})
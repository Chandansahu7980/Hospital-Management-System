
// code for slider....
var num = 1;
$("#next-slider").click(function () {
    num++;
    num = num % 3 + 1;
    if (num == 1) {
        $("#img-wraper").css("background-image", "url('./Images/sliderImg1.jpg')");
    }
    if (num == 2) {
        $("#img-wraper").css("background-image", "url('./Images/sliderImg2.jpg')");
    }
    if (num == 3) {
        $("#img-wraper").css("background-image", "url('./Images/sliderImg3.jpg')");
    }
});

// code for gallery
$(".imgs-container").hide();
$("#all-imgs").show();

$("#all-btn").click(function () {
    $(".imgs-container").hide();
    $("#all-imgs").show();
});

$("#dental").click(function () {
    $(".imgs-container").hide();
    $("#dental-imgs").show();
});

$("#neuro").click(function () {
    $(".imgs-container").hide();
    $("#neuro-imgs").show();
});

$("#cardio").click(function () {
    $(".imgs-container").hide();
    $("#cardio-imgs").show();
});

$("#lab-btn").click(function () {
    $(".imgs-container").hide();
    $("#lab-imgs").show();
});



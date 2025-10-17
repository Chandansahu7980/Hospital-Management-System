
$(document).ready(function () {
    console.log("document is ready");
    // set time and date in top of the page
    var daysArray = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    setInterval(function () {
        var today = new Date();
        $(".weak-day").html(daysArray[today.getDay()]);
        $("#cur-date").html(today.toDateString().substring(4));
        $(".date-time").html(today.toLocaleTimeString());
        var timeStr = today.getHours().toString() + today.getMinutes().toString() + today.getSeconds().toString();
        // console.log(timeStr);
        if (timeStr == 191010) {
            $.ajax({
                url: 'setExpiredStsApnts.php'
            }).done(function (data) {
                $("body").append(data);
            });
        }
    }, 1000);

    $(".right-main .dashboard").show();
    $(".left-bar ul li").removeClass("li-active");
    $(".left-bar #dashboard-btn").addClass("li-active");
    $(".right-top-bar h2 #cur-tab").text("> Dashboard");

    function DashboardAjax() {
        $.ajax({
            url: 'loadDashBoard.php',
            success: function (data) {
                $(".right-main .dashboard").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .dashboard").text("Error in the AJAX request.");
            }
        })
    }
    DashboardAjax();

    function DeptAjax() {
        $.ajax({
            url: 'loadDeptDetail.php',
            success: function (data) {
                $(".right-main .department .dept-tbl-detail").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .department").text("Error while loading Department Data");
            }
        });
    }

    function DocAjax() {
        var searchTerm = $(".doctor .search-bar #search-item").val();
        var dept = $(".doctor .search-bar #spec").val();
        var adminPass = $(".doctor .search-bar #adminPass").val();
        $.ajax({
            url: 'loadDocDetail.php',
            method: 'POST',
            data: {
                "search-term": searchTerm,
                "dept": dept,
                "adminPass": adminPass
            },
            success: function (data) {
                $(".right-main .doctor .doc-tbl-detail").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .doctor").text("Error while loading Doctor Data");
            }
        });
    }

    function PatAjax() {
        var searchItem = $(".patient .search-bar #search-term").val();
        var disease = $(".patient .search-bar #disease").val();
        var gender = $(".patient .search-bar #gender").val();
        var treatSts = $(".patient .search-bar #treatSts").val();
        console.log(searchItem, disease, gender, treatSts);
        $.ajax({
            url: 'loadPatDetail.php',
            method: 'POST',
            data: {
                "searchItem": searchItem,
                "disease": disease,
                "gender": gender,
                "treatSts": treatSts
            },
            success: function (data) {
                $(".right-main .patient .pat-tbl-detail").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .patient").text("Errot in Reading Patient Detail.");
            }
        })
    }

    $(".apnts .search-bar #formDate").change(function () {
        $(".apnts .search-bar #toDate").attr("min", $(".apnts .search-bar #formDate").val());
    });

    function ApntAjax() {
        var searchTerm = $(".apnts .search-bar #searchTerm").val();
        var dept = $(".apnts .search-bar #dept").val();
        var formDate = $(".apnts .search-bar #formDate").val();
        var toDate = $(".apnts .search-bar #toDate").val();
        var sts = $(".apnts .search-bar #sts").val();
        var apnt_type = $(".apnts .search-bar #apnt-type").val();
        console.log(searchTerm, dept, formDate, toDate, sts, apnt_type);
        $.ajax({
            method: 'POST',
            data: {
                "seachTerm": searchTerm,
                "dept": dept,
                "formDate": formDate,
                "toDate": toDate,
                "sts": sts,
                "apntType": apnt_type
            },
            url: 'loadApntDetail.php',
            success: function (data) {
                $(".right-main .apnts .apnt-tbl-detail").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .apnts").text("Error in Reading Apoinments from Database");
            }
        })
    }

    function MediHistAjax() {
        var searchTerm = $(".medi-hist .search-bar #searchTerm").val();
        var dept = $(".medi-hist .search-bar #dept").val();
        var date = $(".medi-hist .search-bar #date").val();
        $.ajax({
            url: 'loadMediHistDetail.php',
            method: 'POST',
            data: {
                "searchTerm": searchTerm,
                "dept": dept,
                "date": date
            },
            success: function (data) {
                $(".right-main .medi-hist .medi-hist-tbl-detail").html(data);
            },
            error: function (e) {
                console.log(e);
                $(".right-main .medi-hist").text("Error in reading Medical history Data");
            }
        });
    }

    function PatQueryAjax(){
        $.ajax({
            url:'loadPatQueries.php',
            success:function(data){
                $(".right-main .pat_queries .pat_queries_table").html(data);
            }
        })
    }

    $(".left-bar #dashboard-btn").click(function () {
        console.log("dashboard clicked");
        $(".right-main-content").hide();
        $(".right-main .dashboard").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #dashboard-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Dashboard");
    });

    $(".left-bar #department-btn").click(function () {
        console.log("Dept clicked");
        $(".right-main-content").hide();
        $(".right-main .department").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #department-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Department");
        DeptAjax();
    });

    $(".left-bar #doctor-btn").click(function () {
        console.log("doctor clicked");
        $(".right-main-content").hide();
        $(".right-main .doctor").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #doctor-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Doctor");
        DocAjax();
    });
    $(".doctor .search-bar button").click(function () {
        DocAjax();
    });

    $(".left-bar #patient-btn").click(function () {
        console.log("patient clicked");
        $(".right-main-content").hide();
        $(".right-main .patient").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #patient-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Patient");
        PatAjax();
    });
    $(".patient .search-bar button").click(function () {
        PatAjax();
    });

    $(".left-bar #apnts-btn").click(function () {
        console.log("apnt clicked");
        $(".right-main-content").hide();
        $(".right-main .apnts").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #apnts-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Appointments");
        ApntAjax();
    });
    $(".apnts .search-bar button").click(function () {
        ApntAjax();
    });

    $(".left-bar #medi-hist-btn").click(function () {
        console.log("Medi hist clicked");
        $(".right-main-content").hide();
        $(".right-main .medi-hist").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #medi-hist-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Medical History");
        MediHistAjax();
    });
    $(".medi-hist .search-bar button").click(function () {
        MediHistAjax();
    });

    $(".left-bar #queries").click(function () {
        console.log("queries clicked");
        $(".right-main-content").hide();
        $(".right-main .pat_queries").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #queries").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Patient Queries");
        PatQueryAjax();
    });

    $(".left-bar #feedback-btn").click(function () {
        console.log("feedback clicked");
        $(".right-main-content").hide();
        $(".right-main .feedback").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #feedback-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Feedbacks");
        $.ajax({
            url: 'loadFeedbacks.php',
            success: function (data) {
                $(".right-main .feedback-tbl-detail").html(data);
            },
            error: function () {
                $(".feedback-tbl-detail").text("Error in reading Feedbacks from DB");
            }
        })
    });

    $(".left-bar #logout-btn").click(function () {
        console.log("logout clicked");
        $(".right-main-content").hide();
        $(".right-main .logout").fadeIn();
        $(".left-bar ul li").removeClass("li-active");
        $(".left-bar #logout-btn").addClass("li-active");
        $(".right-top-bar h2 #cur-tab").text("> Log Out");
    });

});


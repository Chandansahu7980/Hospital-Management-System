$(document).ready(function () {
    var d = new Date();
    var today = d.toISOString().substring(0, 10);
    $("#followup").attr("min", today);

    $("#bp").change(function () {
        if ($("#bp").val() !== '') {
            $("#bp-input").attr("value", "34");
            $(this).hide();
        }
    });
    $("#bs").change(function () {
        if ($("#bs").val() !== '') {
            $("#bs-input").attr("value", "65");
            $(this).hide();
        }
    });
    $("#temp").change(function () {
        if ($("#temp").val() !== '') {
            $("#temp-input").attr("value", "98");
            $(this).hide();
        }
    });

    $("#treatStsBtn").click(function () {
        // alert(ptId);
        var treatmentStatusVal = $("#treatment-status").val();
        if (treatmentStatusVal == "closed") {
            $("#next-followup-sec").hide();
            $("#next-followup-sec input").prop("required", false);
        }
        if (treatmentStatusVal == "ongoing") {
            $("#next-followup-sec").show();
            $("#next-followup-sec input").prop("required", true);
        }
        $.ajax({
            method: 'POST',
            url: 'updateTreatSts.php',
            data: {
                "pId": ptId,
                "status": treatmentStatusVal
            }
        }).done(function (data) {
            console.log(data);
            $("#treatStsBtn+span").html(data);
            $("#treatStsBtn+span").fadeOut(5000);
        });
    });
    $("#diseaseUpdateBtn").click(function () {
        // alert($("#disease").val());
        $.ajax({
            method: 'POST',
            url: 'updateDisease.php',
            data: {
                "ptId": ptId,
                "disease": $("#disease").val()
            }
        }).done(function (data) {
            $("#diseaseUpdateBtn+span").html(data);
            $("#diseaseUpdateBtn+span").fadeOut(5000);

        });
    });
});

function checkPaymentAndStatus() {
    if ($("#status").val() == 1) {
        if ($("#payment").val() == 1) {
            return true;
        } else {
            $("#payment").focus();
            return false;
        }
    } else {
        $("#status").focus();
        return false;
    }
}


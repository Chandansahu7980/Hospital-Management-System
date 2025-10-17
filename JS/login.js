document.getElementById("signUp-btn").addEventListener("click", () => {
    document.getElementById("logIn-form").style.display = "none";
    document.getElementById("signUp-form").style.display = "flex";
});

document.getElementById("logIn-btn").addEventListener("click", () => {
    document.getElementById("logIn-form").style.display = "flex";
    document.getElementById("signUp-form").style.display = "none";
});

function patientSignupValid() {
    var name = document.getElementById("patientName");
    var Fname = document.getElementById("patientFatherName");
    var age = document.getElementById("age");
    var phoneNum = document.getElementById("phoneNumber");
    var EmrNum = document.getElementById("emergency_Number");
    var pw1 = document.getElementById("password1");
    var pw2 = document.getElementById("password2");
    if (!isNaN(name.value)) {
        alert("invalid name");
        name.focus();
        return false;
    }
    if (!isNaN(Fname.value)) {
        alert("invalid Father's name");
        Fname.focus();
        return false;
    }
    if (age.value < 0) {
        alert("Age can't be lessthan 0");
        age.focus();
        return false;
    }
    if (isNaN(phoneNum.value) || (phoneNum.value.length != 10)) {
        alert("Invalid Phone number!");
        phoneNum.focus();
        return false;
    }
    if (isNaN(EmrNum.value) || (EmrNum.value.length != 10)) {
        alert("Invalid Phone number!");
        EmrNum.focus();
        return false;
    }
    if (pw1.value.length < 6) {
        alert("Password must be more then 6 character");
        pw1.focus();
        return false;
    }
    if (pw1.value != pw2.value) {
        alert("Retype password must be same with password");
        pw2.focus();
        return false;
    }
    return true;
}

function doctorSignupValid() {
    var name = document.getElementById("name");
    var age = document.getElementById("age");
    var phoneNum = document.getElementById("phoneNumber");
    var address = document.getElementById("address");
    var pw1 = document.getElementById("password1");
    var pw2 = document.getElementById("password2");
    if (!isNaN(name.value)) {
        alert("invalid name");
        name.focus();
        return false;
    }
    if (age.value < 18) {
        alert("Age can't be lessthan 0");
        age.focus();
        return false;
    }
    if (isNaN(phoneNum.value) || (phoneNum.value.length != 10)) {
        alert("Invalid Phone number!");
        phoneNum.focus();
        return false;
    }
    if (!isNaN(address.value)) {
        alert("invalid address");
        address.focus();
        return false;
    }
    if (pw1.value.length < 6) {
        alert("Password must be more then 6 character");
        pw1.focus();
        return false;
    }
    if (pw1.value != pw2.value) {
        alert("Retype password must be same with password");
        pw2.focus();
        return false;
    }
    return true;
}

function patientLoginValid() {
    var loginPassword = document.getElementById("loginPW");
    if (loginPassword.value.length < 6) {
        alert("Password must be more then 6 !");
        loginPassword.focus();
        return false;
    }
    return true;
}

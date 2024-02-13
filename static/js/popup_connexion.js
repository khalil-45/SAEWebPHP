function openFormLogIn() {
    document.getElementById("loginform").style.display = "block";
    document.getElementById("loginform").style.transitionDelay = "1s";
    document.querySelector(".overlay").style.display = "block";
}

function closeFormLogIn() {
    document.getElementById("loginform").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
}

function openFormSignUp() {
    document.getElementById("signupform").style.display = "block";
    document.getElementById("signupform").style.transitionDelay = "1s";
    document.querySelector(".overlay").style.display = "block";
}

function closeFormSignUp() {
    document.getElementById("signupform").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
}

function openFormMDP() {
    document.getElementById("mdpoublie").style.display = "block";
    document.getElementById("mdpoublie").style.transitionDelay = "1s";
    document.querySelector(".overlay").style.display = "block";
}

function closeFormMDP() {
    document.getElementById("mdpoublie").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
}
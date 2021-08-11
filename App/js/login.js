var loginButton = document.getElementById("login-btn");
var emailAddress = document.getElementById("email");
var password = document.getElementById("password");

loginButton.addEventListener("click", loginUser);

function loginUser(){
    if (!emailInputVerify(emailAddress)||!checkPassword(password)) {
        return;
    }
    let data = {email:emailAddress.value, password:password.value};
    main_ajax_with_call_back(handleLoginResponse,"./logic/procedures/login.procedure.php",data, "POST");
}

/**
 * 
 * @param {XMLHttpRequest} xhttp 
 * @returns 
 */
function handleLoginResponse(xhttp) {
    let jsonResponse = xhttp.responseText.trim();
    let response = JSON.parse(jsonResponse);

    if (response.status !== "OK") {
        showError(response.msg);
        return;
    }
    showSuccess("You have successfully logged in!");
    console.log(response.msg);
    setTimeout(() => {
        if(response.msg == "admin") {
            window.location.href= "./admin.php";
            console.log("admin called");
        }
        if(response.msg == "patient") {
            window.location.href= "./home.php";
            console.log("patient called");
        }
    }, 1000);
}
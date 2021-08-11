var registerButton = document.getElementById("register-btn");
var firstName = document.getElementById("firstname");
var lastName = document.getElementById("lastname");
var emailAddress = document.getElementById("email");
var password = document.getElementById("password");
var confirmPassword = document.getElementById("cpassword");
var action = document.getElementById("action");
var oldPassword = document.getElementById("opassword");
var id = document.getElementById("id");

registerButton.addEventListener("click", function () {
    switch (action.value) {
        case "u":
            updateUser();
            break;
        case "r":
            registerUser();
            break;
    
        default:
            break;
    }
});

function registerUser() {
    if (!nameInputVerify(firstName)||!nameInputVerify(lastName)||!emailInputVerify(emailAddress)||!checkPassword(password)) {
        return;
    }
    if (password.value !== confirmPassword.value) {
        showError("Passwords do not match!");
        return;
    }
    let data = {firstname : firstName.value, lastname : lastName.value, email : emailAddress.value, password : password.value, action : action.value};
    main_ajax_with_call_back(handleRegisterResponse,"./logic/procedures/register.procedure.php",data, "POST");
}
/**
 * 
 * @param {XMLHttpRequest} xhttp 
 */
function handleRegisterResponse(xhttp)
{
    let jsonResponse = xhttp.responseText.trim();
    let response = JSON.parse(jsonResponse);

    if (response.status !== "OK") {
        showError(response.msg);
        return;
    }
    showSuccess(response.msg);

    setTimeout(() => {
        if (action.value = "r") {
            location.href = "./home.php";
        }
        else if(action.value = "u"){
            location.href = "./analytics/users.analytics.php";
        }
    }, 1000);

}

function updateUser() {
    if (!nameInputVerify(firstName)||!nameInputVerify(lastName)||!emailInputVerify(emailAddress)) {
        return;
    }
    let data = {
        firstname : firstName.value, 
        lastname : lastName.value, 
        email : emailAddress.value, 
        action : action.value,
        withPassword : false,
        id : id.value
    };
    if(password.value.length > 0){
        if (checkPassword(password) && password.value !== confirmPassword.value) {
            showError("Passwords do not match!");
            return;
        }
        if (oldPassword) {
            data.oldPassword = oldPassword.value;
        }
        
        data.password = password.value;
        data.withPassword = true;
    }

    console.log(data);
    main_ajax_with_call_back(handleRegisterResponse,"./logic/procedures/register.procedure.php",data, "POST");
}
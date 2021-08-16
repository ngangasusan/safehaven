var registerButton = document.getElementById("register-btn");
var firstName = document.getElementById("firstname");
var lastName = document.getElementById("lastname");
var emailAddress = document.getElementById("email");
var password = document.getElementById("password");
var phoneNumber = document.getElementById("phone");
var confirmPassword = document.getElementById("cpassword");
var action = document.getElementById("action");
var oldPassword = document.getElementById("opassword");
var id = document.getElementById("id");
var profilePicture = document.getElementById("profile_picture");
var question = confirm("Are you sure?");

registerButton.addEventListener("click", function () {
    switch (action.value) {
        case "u":{
            updateUser();
            console.log("update called");
            break;}
        case "r":{
            registerUser();
            console.log("register called");
            break;}
    
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
    }, 1000)
}

function updateUser() {
    
    if (!nameInputVerify(firstName)||!nameInputVerify(lastName)||!emailInputVerify(emailAddress)) {
        return;
    }
    if (phoneNumber.value.length > 0 && !phoneInputVerify(phoneNumber)) {
        return;
    }

    var data = new FormData();
    data.append("firstname", encodeURI(firstName.value));
    data.append("lastname", encodeURI(lastName.value));
    data.append("email", encodeURI(emailAddress.value));
    data.append("phone", encodeURI(phoneNumber.value));
    data.append("action", encodeURI(action.value));
    data.append("withPassword", "false");
    data.append("withPicture", "false");
    data.append("id", id.value);
    

    // let data = {
    //     firstname : firstName.value, 
    //     lastname : lastName.value,
    //     phone: phoneNumber.value, 
    //     email : emailAddress.value, 
    //     action : action.value,
    //     withPassword : false,
    //     id : id.value
    // };

    if(password.value.length > 0){
        if (checkPassword(password) && password.value !== confirmPassword.value) {
            showError("Passwords do not match!");
            return;
        }
        if (oldPassword) {
            data.append("oldPassword", oldPassword.value);
            //data.oldPassword = oldPassword.value;
        }
        
        data.append("password", password.value);
        //data.password = password.value;
        data.append("withPassword", "true");
        //data.withPassword = true;
    }

    //profile picture
    if(profilePicture.files[0]){
        let file = profilePicture.files[0];
        data.append("profilePicture", file);
        data.append("withPicture", "true");
    }

    for (var key of data.entries()) {
        console.log(key[0] + ', ' + key[1]);
    }
    main_ajax_with_call_back(handleRegisterResponse,"./logic/procedures/register.procedure.php",data, "POST",false);

}
function check(){
    if (question) {
       return true; 
    }
    else{
        alert("Chosen not to delete.");
        return false;
    }
    
}
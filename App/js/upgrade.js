var upgradeButton = document.getElementById("upgrade-btn");
var specialty = document.getElementById("specialty");
var hospital = document.getElementById("hospital");
var id = document.getElementById("id");

upgradeButton.addEventListener("click", upgradeUser);

function upgradeUser(){
    if (!nameInputVerify(specialty)||!nameInputVerify(hospital)) {
        return;
    }
    let data = {specialty:specialty.value, hospital:hospital.value};
    main_ajax_with_call_back(handleUpgradeResponse, "./logic/procedures/upgrade.procedure.php",data,"POST");
}

/**
 * 
 * @param {XMLHttpRequest} xhttp 
 * @returns 
 */
function handleUpgradeResponse(xhttp) {
    let jsonResponse = xhttp.responseText.trim();
    let response = JSON.parse(jsonResponse);

    if (response.status !== "OK") {
        showError(response.msg);
        return;
    }
    showSuccess("You have requested for an upgrade!");
    console.log(response.msg);
    setTimeout(() => {
            location.href= "./therapists.php";
            console.log("upgrade request sent");
    }, 1000);
}

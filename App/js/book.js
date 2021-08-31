
 let date = document.getElementById("a-date");
 let sTime = document.getElementById("s-time");
 let eTime = document.getElementById("e-time");
 let therapist = document.getElementById("t-id");
 let bookBtn = document.getElementById("appointment-btn");

 // Use Javascript
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    let yyyy = today.getFullYear();
    if(dd<10){
    dd='0'+dd
    } 
    if(mm<10){
    mm='0'+mm
    } 

    cday = yyyy+'-'+mm+'-'+dd;
    date.setAttribute("min", cday);

 bookBtn.addEventListener("click", ()=>{
    if(date.value.length < 1){
        showError("Please choose a date");
        return;
    }

    if(sTime.value.length < 1){
        showError("Please choose a start time");
        return;
    }

    if(eTime.value.length < 1){
        showError("Please choose an end time");
        return;
    }

    if(therapist.value.length < 1){
        showError("A therapist is not selected");
        return;
    }

    if(eTime.value <= sTime.value){
        showError("End time must be greater than start time");
        return;
    }

    main_ajax_with_call_back(handleBookingResponse, "./logic/procedures/book.procedure.php", {
        d: date.value, s: sTime.value, e: eTime.value, t:therapist.value
    }, "POST");
 });

 function handleBookingResponse(xhttp){
     let response = xhttp.responseText;
        console.log("data: "+response);
     jRes = JSON.parse(response);
     if(jRes.status != "OK"){
         showError(jRes.msg);
         return;
     }

     showSuccess(jRes.msg);
     //console.log(reponse.msg);
     setTimeout(() => {
         window.location.href = "./therapists.php";
     }, 1000);
 }
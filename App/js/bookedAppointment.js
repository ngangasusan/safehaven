function approve(element) {
    if (confirm("Do you want to accept this appointment?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        alert("Appointment accepted successfully");
        location.reload();
    }
  };
  xhttp.open("POST", "logic/procedures/bookedAppointment.procedure.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("approvedId="+element.id);
    }
    
}

function decline(element) {
    if (confirm("Do you want to decline this appointment request?")) {
        var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert("Appointment was declined successfully");
        location.reload();
      }
    };
    xhttp.open("POST", "logic/procedures/bookedAppointment.procedure.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("declinedId="+element.id);
    }
}
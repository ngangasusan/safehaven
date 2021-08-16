error = document.getElementById("error");
success_div = document.getElementById("success-display");

function makeLoadElem(side = null){
    if(!side){
        side = '200px';
    }
    let rootDiv = document.createElement("div");
    rootDiv.id = "loading-img";
    rootDiv.style.width = side;
    rootDiv.style.height = side;
    rootDiv.setAttribute("class", "loadingio-spinner-dual-ball-8953mcjn5x4");
    sndLoadingHolder = document.createElement("div");
    sndLoadingHolder.setAttribute("class", "ldio-n1u8azv0s9");
    sndLoadingHolder.innerHTML = "<div></div><div></div>";
    rootDiv.append(sndLoadingHolder);
    return rootDiv;
}

function makeLoadingOverlay(){
    let popup_underlay = document.createElement("div");
    popup_underlay.classList.add("popup_underlay");
    popup_underlay.id= "loading-cover-underlay";
    document.querySelector("body").appendChild(popup_underlay);
    popup_underlay.style.opacity = '0.35';
    let rootElem = makeLoadElem();
    rootElem.id = "loading-cover";
    rootElem.style.position = "absolute";
    rootElem.style.top = "50%";
    rootElem.style.left = "50%";
    rootElem.style.transform = "translate(-50%, -50%)";
    rootElem.style.zIndex = "5000";
    document.querySelector("body").appendChild(rootElem);
    rootElem.scrollIntoView({behavior: "smooth", block: "center"})
}

function removeLoadCover(){
    let loadingCover = document.querySelectorAll("#loading-cover");
    loadingCover.forEach(cov =>{
      cov.remove();
    });

    let loadingCoverUnderlay = document.querySelectorAll("#loading-cover-underlay");
    loadingCoverUnderlay.forEach(cov =>{
        cov.remove();
    });
}

function makeAnnimatedCheckmark(side = null){
    let root = document.createElement("div");
    root.id = "animated-checkmark";
    if(side){
        root.style.width = side;
    }

    root.innerHTML = "<svg class='checkmark' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 52 52'><circle class='checkmark__circle' cx='26' cy='26' r='25' fill='none'/><path class='checkmark__check' fill='none' d='M14.1 27.2l7.1 7.2 16.7-16.8'/></svg>";
    return root;
}

function displayAnimatedCheckMark(parentElem, width, append_result = false){
    let checkmark = makeAnnimatedCheckmark(width);
     if(append_result != true){
           parentElem.innerHTML = "";
     }
     checkmark.style.transform = "translate(100%, 0%)";   
     parentElem.appendChild(checkmark);
}

function removeAnimatedCheckMark(){
    let checkmark = document.getElementById("animated-checkmark");
    if(checkmark){
        checkmark.parentElement.removeChild(checkmark);
    }
}

//universal ajax
/**
 * 
 * @param {HTMLElement} element_to_change 
 * @param {String} url 
 * @param {object} data 
 * @param {string} send_format 
 * @param {bool} append_result 
 */

function main_ajax_with_element(element_to_change, url, data, send_format, append_result = false){
    send_format = send_format.toLowerCase();
    data = serialize(data);
    var xhttp;
    if(window.XMLHttpRequest){
        xhttp = new XMLHttpRequest();
    }else{
        xhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
    }
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            if(append_result){
                removeLoadIcon();
                element_to_change.innerHTML += this.responseText;
            }else{
                element_to_change.innerHTML = this.responseText;
            }
        }
        else{
            if(this.readyState == 1){
                loadIcon(element_to_change, append_result, "100px");
            }
            
        }
    }

    if(send_format == 'post'){
        xhttp.open("POST",url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(data);

    }else{
        xhttp.open("GET", url+"/?"+data, true);
        xhttp.send();
    }
}

/**
 * Makes an AJAX request and returns the XMLHTTPRequest object to the callback
 * @param {Function} call_back - callback function to handle the response
 * @param {String} url - the file to send the request to
 * @param {Object} data - an object with the data to send
 * @param {String} send_format - POST or GET
 * @param {Boolean} set_header - should the header Content-Type: application/x-www-form-urlencoded be set? Default is true
 */
function main_ajax_with_call_back(call_back, url, data, send_format, set_header = true){
    send_format = send_format.toLowerCase();
    if (set_header) {
        console.log("serializing data");
    data = serialize(data);
    }
    var xhttp;
    if(window.XMLHttpRequest){
        xhttp = new XMLHttpRequest();
    }else{
        xhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
    }
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            call_back(this);
        }
    }

    if(send_format == 'post'){
        xhttp.open("POST",url, true);
        if(set_header){
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }  
        xhttp.send(data);

    }else{
        xhttp.open("GET", url+"/?"+data, true);
        xhttp.send();
    }
}

function nameInputVerify(element, error = null){
    element.style.borderColor = "";
    hideError(error);
    if(!element.value.match(/^[\w]+(\s?[\w\-_\'\.]+?\s*?)+?$/)){
        setTimeout(()=>{
            if(!element.value.match(/^[\w]+(\s?[\w\-_\'\.]+?\s*?)+?$/)){
                showError("At least one letter. Only A-Z,a-z,',- and _ are allowed", error);
            }
            
        }, 3000);
        element.style.borderColor = "red";
        return false;
    }
      
    return true;
}

function descInputVerify(element, error = null){
    element.style.borderColor = "";
    hideError(error);
    if(!element.value.match(/^[\w\s,-_:\(\)!\'\"\+\.\r\t\n]+$/)){
        setTimeout(()=>{
            if(!element.value.match(/^[\w\s,-_:\(\)!\'\"\+\.\r\t\n]+$/)){
                showError( "Must start with a letter or you have entered an invalid character", error);
            }
            
        }, 3000);
        element.style.borderColor = "red";
        return false;
    }
    return true;
}

function phoneInputVerify(element, error = null){
    element.style.borderColor = "";
    element.value = element.value.trim();
    hideError(error);
    if(element.value[0] == "0"){
        element.value = "+254" + element.value.substr(1);
    }
    if(!element.value.match(/^\+?\d{12,15}$/)){
        setTimeout(()=>{
            if(!element.value.match(/^\+?\d{12,15}$/)){
                showError("Example of an accepted Phone number: +2547123456789", error);
            }
            
        }, 3000);
        element.style.borderColor = "red";
        return false;
    }
    return true;
}

function emailInputVerify(element, error=null){
    element.style.borderColor = "";
    hideError(error);
    element.value = element.value.trim();
    if(!element.value.match(/^[a-z0-9.!#$%&*+/=?^_{|}~-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/)){
        setTimeout(()=>{
            if(!element.value.match(/^[a-z0-9.!#$%&*+/=?^_{|}~-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/)){
                showError("email example: example@email.com", error);
            }
            
        }, 3000);
        element.style.borderColor = "red";
        return false;
    }
    return true;
}

function checkPassword(password, error_div=null){
    let _error = error;
    if (error_div) { 
        _error = error_div;
    }
    hideError(_error);
    password.style.borderColor = "";
    if(password.value.length >= 9){
        if(password.value.match(/[A-Z]/)){
           if(password.value.match(/[a-z]/)){
              if(password.value.match(/\d/)){
                _error.innerHTML = "";
                password.style.borderColor = "";
                return true;
              }
              else{
               //numbers must be included
               showError("Include Numbers in your password", _error=null);
               password.style.borderColor = "red";
               return false;
              }
           }else{
             //lowercase letters must be included
             showError("Your password must include lowercase letters", _error=null);
             password.style.borderColor = "red";
             return false;
           }
        }
        else{
        //upper case letters
         showError("Your password must include uppercase", _error=null);
         password.style.borderColor = "red";
         return false;
        }
     }
     else{
      //password is short
      showError("Your password must have at least 9 characters", _error=null);
      password.style.borderColor = "red";
      return false;
     }
     
}

//Limiting user input
function charCount(numOfChar, elem, tclass = ""){
    
    let theTitle = document.getElementById(elem.id+"-count");
    if(theTitle == null){
    let root = document.createElement('div');
    root.classList.add("char-count");
    if(tclass != ""){
        root.classList.add(tclass);
    }
    root.id = elem.id + "-count";
    root.innerHTML = elem.value.length+" / "+numOfChar;
    elem.after(root);
    theTitle = document.getElementById(elem.id+"-count");
    }else{
      elem.onblur = function(){
        theTitle.remove();
      }
      
      
      
      if(elem.value.length >= numOfChar){
        elem.value = elem.value.substr(0,numOfChar);
        theTitle.style.backgroundColor="red";
      }
      else if(elem.value.length >= 0.75 *numOfChar){
        theTitle.style.backgroundColor="orangered";
      }
      else if(elem.value.length >= 0.5 *numOfChar){
        theTitle.style.backgroundColor="blue";
      }
      else{
        theTitle.style.backgroundColor = "";
      }
      theTitle.innerHTML = elem.value.length+" / "+numOfChar;
    }
    
}


function showError(data, error_div = null){
    hideSuccess();
    if(error_div){
        error_div.style.opacity = "1";  
        error_div.addEventListener('transitionend', ()=>{
            error_div.innerHTML = data;
        });

        error_div.scrollIntoView({behavior: "smooth", block: "center"});
        setTimeout(() => {
            hideError(error_div);
        }, 5000);
        return;
    }
    error.style.opacity = "1";
    error.addEventListener('transitionend', ()=>{
        error.innerHTML = data;
    });
    viewError();
    setTimeout(() => {
        hideError();
    }, 5000);
}

function hideError(error_div = null){
    if(error_div){
        error_div.style.opacity = "0";
        error_div.addEventListener('transitionend', ()=>{
            error_div.innerHTML = "";
        });
        
        return;
    } 
    
    error.style.opacity = "0";
    error.addEventListener('transitionend', ()=>{
        error.innerHTML = "";
    });
}
if(error){
    hideError();
}

function showSuccess(data)
{
    hideError();
    success_div.style.opacity = "1"; 
    success_div.addEventListener('transitionend', ()=>{
        success_div.innerHTML = data;
    });
    viewSuccess();
    setTimeout(() => {
        hideSuccess();
    }, 5000);
}
 
function viewError(){
    error.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function viewSuccess(){
    success_div.scrollIntoView({behavior: "smooth", block: "nearest"});
}

function hideSuccess()
{
    success_div.style.opacity = "0";
    
    success_div.addEventListener('transitionend', ()=>{
        success_div.innerHTML = "";
    });
}

if(success_div){
    hideSuccess();
}

if(error){
    hideSuccess();
    hideError();
}

 function showPopupNotification(html_to_display)
 {
     let popup_underlay = document.createElement("div");
     popup_underlay.classList.add("popup_underlay");
     document.querySelector("body").appendChild(popup_underlay);
     popup_underlay.style.opacity = '0.5';
     let rootElem = document.createElement("div");
     rootElem.id = "popup_notification";
     rootElem.innerHTML = html_to_display;
     rootElem.classList.add("popup");
     document.querySelector("body").appendChild(rootElem);
     rootElem.style.opacity = '1';
     return;
     
 }

 function hidePopupNotification(){
     let popup_underlay = document.querySelector(".popup_underlay");

     let rootElem = document.getElementById("popup_notification");
     if(rootElem)
     {
         rootElem.style.opacity = '0';
         rootElem.addEventListener('transitionend', ()=>{
             rootElem.parentElement.removeChild(rootElem);
             popup_underlay.parentElement.removeChild(popup_underlay);
         });
    
     }
 }

 function loadIcon(elem, append_result = false, side = null){
     let loader = makeLoadElem(side);
     if(append_result != true){
           elem.innerHTML = "";
     }   
     elem.appendChild(loader);
 }

 function removeLoadIcon(){
     if(document.getElementById("loading-img")){
        document.getElementById("loading-img").remove();
     }

 }

 function scrollToTop(){
     document.body.scrollTop = 0;
     document.documentElement.scrollTop = 0;
 }


 function goBack(){
     makeLoadingOverlay();
     window.history.back();
 }

var isonline = true;

window.addEventListener('load', checkOnlineStatus);

function checkOnlineStatus(){
    if(navigator.onLine){
        isonline = true;
    }else{
        isonline = false;
        window.addEventListener('online', function(){
            this.location.reload();
        });
    }
}

//countdown shower
var onIndex = document.getElementById("on-index");

window.addEventListener('offline', checkOnlineStatus);

serialize = function(obj) {
    var str = [];
    for (var p in obj)
      if (obj.hasOwnProperty(p)) {
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
      }
    return str.join("&");
  }

  
  /*Toggle dropdown list*/
  function toggleDD(myDropMenu) {
      document.getElementById(myDropMenu).classList.toggle("invisible");
  }
  /*Filter dropdown options*/
  function filterDD(myDropMenu, myDropMenuSearch) {
      var input, filter, ul, li, a, i;
      input = document.getElementById(myDropMenuSearch);
      filter = input.value.toUpperCase();
      div = document.getElementById(myDropMenu);
      a = div.getElementsByTagName("a");
      for (i = 0; i < a.length; i++) {
          if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
              a[i].style.display = "";
          } else {
              a[i].style.display = "none";
          }
      }
  }
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
      if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
          var dropdowns = document.getElementsByClassName("dropdownlist");
          for (var i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (!openDropdown.classList.contains('invisible')) {
                  openDropdown.classList.add('invisible');
              }
          }
      }
  }


  

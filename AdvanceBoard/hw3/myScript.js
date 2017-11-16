/**
 * Created by xiaolongzhou on 8/28/17.
 */

// create a XML Http Request
function createXHR() {
    try {return new XMLHttpRequest(); } catch(e) {}
    try {return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch(e) {}
    try {return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch(e) {}
    try {return new ActiveXObject("Msxml2.XMLHTTP"); } catch(e) {}
    try {return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {}

    alert("XMLHttpRequest not supported");
    return null;
}

// Validating Empty Field
function check_empty() {
    if (document.getElementById('loginEmail').value === "" || document.getElementById('loginPassword').value === ""){
        alert("Fill All Fields !");
    } else {
        var xhr = createXHR();

        if(xhr) {
            xhr.open("POST", "http://138.197.198.28/hw3/signIn.php",true);
            // set the time out interval
            xhr.timeout = 2000;  // milliseconds
            xhr.onreadystatechange = function() {handleResponse(xhr)};
            xhr.ontimeout = function(e) {
                errorPop("Connection Timeout, Please Try it again!");
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("emailAddress="+document.getElementById('loginEmail').value+"&password="+
                document.getElementById('loginPassword').value);
        }
    }
}

function handleResponse(xhr)
{
    if (xhr.readyState === 4 && xhr.status === 200) {
       window.open('http://138.197.198.28/hw3/private.php','_self');
    }
    else if (xhr.readyState ==4)
    {
        alert(xhr.statusText);
    }
}

function checkSignup() {
    if (document.getElementById('firstName').value === "" || document.getElementById('lastName').value === "" ||
        document.getElementById('signupEmail').value === "" || document.getElementById('signupPassword').value === ""){
        alert("Fill All Fields !");
    }
    else if(document.getElementById('checkPassword').value!=
    document.getElementById('signupPassword').value)
    {
      alert('password dismatch!');
    } else {
        var xhr = createXHR();

        if(xhr) {
            xhr.open("POST", "http://138.197.198.28/hw3/signUp.php",true);
            // set the time out interval
            xhr.timeout = 2000;  // milliseconds
            xhr.onreadystatechange = function() {handleResponse(xhr)};
            xhr.ontimeout = function(e) {
                errorPop("Connection Timeout, Please Try it again!");
            };
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("firstName="+document.getElementById('firstName').value+"&lastName="+
                document.getElementById('lastName').value + "&emailAddress=" + 
                document.getElementById('signupEmail').value
                + "&password=" + document.getElementById('signupPassword').value);
        }
    }
}

var from;
//Function To Display Popup
function showLogin() {
    document.getElementsByClassName('abc')[0].style.display = "block";
}
//Function to Hide Popup
function hideLogin(){
    document.getElementsByClassName('abc')[0].style.display = "none";
}

//Function To Display Popup
function showSignup() {
    document.getElementsByClassName('abc')[1].style.display = "block";
}
//Function to Hide Popup
function hideSignup(){
    document.getElementsByClassName('abc')[1].style.display = "none";
}

function showSBForm()
{
  document.getElementsByClassName('abc')[0].style.display = "block";
}

function hideSBForm()
{
  document.getElementsByClassName('abc')[0].style.display = "none";
}
function showdelSB(ele)
{
  from=ele;
  document.getElementsByClassName('abc')[2].style.display = 'block';
}
function cancelDel()
{
  document.getElementsByClassName('abc')[2].style.display = 'none';
}
function showSBedit(ele)
{
  from=ele;
  document.getElementsByClassName('abc')[1].style.display = "block";
}

function hideSBedit()
{
  document.getElementsByClassName('abc')[1].style.display = "none";
}

function signOut() {
  var xhr = createXHR();
  if(xhr) {
      xhr.open("GET", "http://138.197.198.28/hw3/signOut.php",true);
      // set the time out interval
      xhr.timeout = 2000;  // milliseconds
      xhr.ontimeout = function(e) {
        errorPop("Connection Timeout, Please Try it again!");
      };
      xhr.send();
  }
  window.open("http://138.197.198.28/hw3/index.php","_self");
}

function validateForm()
{
  var x = document.forms["form"]["myBoardName"].value;
  if(x == "")
  {
    alert("Please enter a name.");
    return false;
  }
  var xhr = createXHR();
  if(xhr) {
      xhr.open("POST", "http://138.197.198.28/hw3/action.php",true);
      // set the time out interval
      xhr.timeout = 2000;  // milliseconds
      xhr.onreadystatechange = function() {addSBResponse(xhr)};
      xhr.ontimeout = function(e) {
        alert("Connection Timeout, Please Try it again!");
      };   
    var newTitle=document.getElementById('myBoardName').value;
    for(var i=0;i<newTitle.length;i++)
    {
      var asc = newTitle.charCodeAt((i));
      if(asc!=32&&(asc<48 || (65>asc&&asc>57) || (asc>90&&asc<97) || 
      asc>122))
      {
        alert("board name can only contain numbers, alphabets and spaces");
        return;
      }
    }
    if(newTitle.length>35)
    {
        alert("board name too long!");
        return;
    }
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
      xhr.send("action="+document.getElementsByName("action")[0].value+"&myBoardName="+
        document.getElementById('myBoardName').value);
  }
}

function addSBResponse(xhr)
{ 
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.reload(true);
    }
    else if (xhr.readyState ==4)
    {
        alert(xhr.statusText);
    }
} 

function delSB()
{
  var xhr = createXHR();
  if(xhr) {
      xhr.open("POST", "http://138.197.198.28/hw3/action.php",true);
      // set the time out interval
      xhr.timeout = 2000;  // milliseconds
      xhr.onreadystatechange = function() {addSBResponse(xhr)};
      xhr.ontimeout = function(e) {
        errorPop("Connection Timeout, Please Try it again!");
      };   
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
      var title= from.parentElement.parentElement.children[0].children[0].innerHTML;
      xhr.send("action=deleteSoundBoard&title="+ title); 
  }
}

function editSB()
{
  var ele=from;
  var xhr = createXHR();
  if(xhr) {
    xhr.open("POST", "http://138.197.198.28/hw3/action.php",true);
    xhr.timeout = 2000;  // milliseconds
    xhr.onreadystatechange = function() {addSBResponse(xhr)};
    xhr.ontimeout = function(e) {
      errorPop("Connection Timeout, Please Try it again!");
    };   
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    var newTitle=document.getElementById("newtitle").value;
    var title= ele.parentElement.parentElement.children[0].children[0].innerHTML;
    for(var i=0;i<newTitle.length;i++)
    {
      var asc = newTitle.charCodeAt((i));
      if(asc!=32&&(asc<48 || (65>asc&&asc>57) || (asc>90&&asc<97) || 
      asc>122))
      {
        alert("board name can only contain numbers, alphabets and spaces");
        return;
      }
    }
    if(newTitle.length>35)
    {
        alert("board name too long!");
        return;
    }
    xhr.send("action=editSoundBoard&newTitle="+document.getElementById("newtitle").value+
    "&oldTitle="+title);
    }
}
function displaySounds(ele) {
  var xhr = createXHR();
  if(xhr) {
    if(window.location.href=="http://138.197.198.28/hw3/index.php")
    {
      xhr.open("POST", "http://138.197.198.28/hw3/publicboard.php",true);
    }
    else
    {
      xhr.open("POST", "http://138.197.198.28/hw3/private.php",true);
    }
    xhr.timeout = 2000;  // milliseconds
    xhr.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200){
      if(window.location.href=="http://138.197.198.28/hw3/index.php")
      {
        window.open("http://138.197.198.28/hw3/publicboard.php","_self");
      }
      else
      {
        window.open("http://138.197.198.28/hw3/private.php","_self");
      }
        }
        else if(this.readyState==4)
        {
          alert(xhr.statusText);
        }
    }
    xhr.ontimeout = function(e) {
      errorPop("Connection Timeout, Please Try it again!");
    }   
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    var title= ele.innerHTML;
    var publi = ele.parentElement.parentElement.getAttribute("name");
    if(publi == "public")
    {
        publi = "1";
    }
    else
    {
        publi = "0";
    }
    xhr.send("title="+title+"&public="+publi);
  }
}

function showUploadForm()
{
  document.getElementsByClassName("abc")[0].style.display = "block";
  
}

function hideUploadForm()
{
  document.getElementsByClassName("abc")[0].style.display = "none";
}
function showdelS(ele)
{
  from = ele;
  document.getElementsByClassName("abc")[1].style.display = "block";
}
function hidedelS()
{
  document.getElementsByClassName("abc")[1].style.display = "none";
}

function delS()
{
  var xhr = createXHR();
  if(xhr) {
      xhr.open("POST", "http://138.197.198.28/hw3/action.php",true);
      // set the time out interval
      xhr.timeout = 2000;  // milliseconds
      xhr.onreadystatechange = function() {addSBResponse(xhr)};
      xhr.ontimeout = function(e) {
        errorPop("Connection Timeout, Please Try it again!");
      };   
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
      var path = from.parentElement.parentElement.children[0].children[1].
      children[0].getAttribute("src");
      var boardid = from.parentElement.parentElement.children[0].children[1].
      getAttribute("boardid");
      var image_path = from.parentElement.parentElement.children[0].
      style.backgroundImage.slice(5,-2);
      xhr.send("action=deleteSound&path="+ path + "&boardid=" + boardid
      + "&image_path=" + image_path); 
  }
}

function play(ele)
{
   var audio=ele.children[1];
   audio.onended = function(){
      ele.children[0].setAttribute("src",
      "http://138.197.198.28/hw3/play.png");
    ele.children[0].style.display = "none"; 
   }
   if(audio.paused)
   {
      audio.play();
      ele.children[0].setAttribute("src",
      "http://138.197.198.28/hw3/pause.png");
      var xhr = createXHR();
      if(xhr) {
        xhr.open("POST", "http://138.197.198.28/hw3/action.php",true);
        // set the time out interval
        xhr.timeout = 2000;  // milliseconds
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
       var title= ele.children[1].children[0].getAttribute("src");
       xhr.send("action=listenToSound&soundName="+ title ); 
  }
   }
   else
   {
      audio.pause();
      ele.children[0].setAttribute("src",
      "http://138.197.198.28/hw3/play.png");
   }
   
}
function showPPPic(ele)
{
  ele.children[0].style.display = "block"; 
}
function hidePPPic(ele)
{
  if(ele.children[1].paused)
  {
    ele.children[0].style.display = "none"; 
  }
}

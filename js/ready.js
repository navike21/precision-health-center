loadDoc = () => {
  let fullname = document.getElementById('fullname');
  let email = document.getElementById('email');
  let phone = document.getElementById('phone');
  let message = document.getElementById("message");
  let dataComplete = false;

  // if(fullname.value !== "" && email.value !== "" && phone.value !== ""){
  if(fullname.value !== "" && email.value !== ""){
  
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        message.classList.add("fadeIn")
        setTimeout(() => {
          message.classList.remove("fadeIn");
          fullname.value = "";
          email.value = "";
          phone.value = "";
        }, 2500);
      }
    };
    xhttp.open("POST", "../sendmail/", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // xhttp.send("name=" + fullname.value + "&email=" + email.value + "&phone=" + phone.value);
    xhttp.send("name=" + fullname.value + "&email=" + email.value + "&phone=" + "");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  // Handler when the DOM is fully loaded
  let formData = document.getElementById('formData');
  formData.addEventListener("submit", loadDoc, true);
});
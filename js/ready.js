loadDoc = (name, email, phone) => {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // document.getElementById("demo").innerHTML = this.responseText;
      console.log(this.responseText)
    }
  };
  xhttp.open("POST", "https://precisionhealthcenters.com/sendMail/", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name=" + name + "&email=" + email + "&phone=" + phone);
}

document.addEventListener("DOMContentLoaded", function () {
  // Handler when the DOM is fully loaded
  let formData = document.getElementById('formData');
  let fullname = document.getElementById('fullname');
  let email = document.getElementById('email');
  let phone = document.getElementById('phone');
  let dataComplete = false;

  if(fullname.val !== "" && email.val !== "" && phone.val !== ""){
    formData.addEventListener("submit", loadDoc, true);
  }
});
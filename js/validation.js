

//sign up validation
// const form = document.getElementById('sign_form_submit');



// form.addEventListener('submit', function(e){
//   e.preventDefault();

function checkInput(){
  const username = document.getElementById('name');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
    //get the values from the inputs.
    console.log("inisde checkinput")
    const usernameValue = username.value.trim();   //Removes the leading and trailing white space and line terminator characters from a string.
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
    if (usernameValue === '') {
      //show error
      //add error class
      setErrorFor(username, 'Username cannot be blank');
      return false;
    }
    else {
      //add success class
      setSuccessFor(username);
    }
  
    if (emailValue === '') {
      setErrorFor(email, 'Email cannot be blank');
      return false;
    }
    else if(!isEmail(emailValue)){
      setErrorFor(email, 'Enter correct email');
      return false;
    }
    else {
      setSuccessFor(email);
    }
    if (phoneValue === '') {
      setErrorFor(phone, 'Phone no. cannot be blank');
      return false;
    }
    else if (phoneValue.length !== 10) {
      setErrorFor(phone, 'Enter 10 digit phone number');
      return false;
    }
    else if(!isPhone(phoneValue)){
      setErrorFor(phone, 'Enter valid phone number');
      return false;
    }
    else {
      setSuccessFor(phone);
    }
    if (passwordValue.match(passw)) {
      setSuccessFor(password);
    }
    else if (passwordValue === '') {
      setErrorFor(password, 'Password cannot be blank');
      return false;
    }
    else {
      setErrorFor(password, 'Minimum eight characters, at least one uppercase letter, one lowercase letter and one number');
      return false;
    }
  
    if (password2Value === '') {
      setErrorFor(password2, 'Password2 cannot be blank');
      return false;
    }
    
    else if (passwordValue !== password2Value) {
      setErrorFor(password2, 'Password does not match');
      return false;
    }
    else {
      setSuccessFor(password2);
    }
    
}
;


function setErrorFor(input, message) {
  const formControl = input.parentElement;  // points to .form-condrol(here 'input' is child of '.form-control'.
  const small = formControl.querySelector('small');

  //add error class
  formControl.className = 'form-control error';

  //add error message inside small
  small.innerText = message;
  return false;

}
function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = 'form-control success';
  return true;
}
function isPhone(phone){
  return /^98\d{8}$/.test(phone)
}
function isEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

//password show and hide
function passwordFun() {
  const x = document.getElementById("password");
  const x2 = document.getElementById("password2");
  const hide = document.querySelector(".fa-eye");
  const show = document.querySelector(".fa-eye-slash");

  if (x.type === "password") {
    x.type = "text";
    x2.type = "text";
    
  }
   else {
    x.type = "password";
    x2.type = "password";
    
  }
}





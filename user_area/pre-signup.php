<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />

    <!-- Font-awesome icons -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />

    <!-- FavIcon -->
    <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

    <!-- Custom style -->
    <link rel="stylesheet" href="../css/styles.css" />

    <!-- Lightbox -->
    
    <!-- Slick -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fresh - Digital Farm Nepal</title>
  </head>
  <body>
    <div class="register">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-xl-12">
            <div class="logo">
              <img src="./img/company/logo.png" alt="" />
            </div>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12">
          <form action="./signup.php" method="get">
            <div class="options-wrapper">
              <div class="section-title">
                <h1 class="md-heading">Join Farm Mart as</h1>
              </div>
              <div class="options">
                <div class="options_details active">
                  <div class="options_icons">
                    <input type="radio" name="role" id="farmer" class="radio_options" value="farmer" checked/>
                  </div>

                  <h6>I'm a Farmer</h6>
                </div>
                <div class="options_details">
                  <div class="options_icons">
                    <input type="radio" name="role" id="consumer" class="radio_options" value="consumer"/>
                  </div>
                  <h6>I'm a Consumer</h6>
                </div>
                <div class="options_details">
                  <div class="options_icons">
                    <input type="radio" name="role" id="vendor" class="radio_options" value="vendor"/>
                  </div>
                  <h6>I'm a Vendor</h6>
                </div>
                <div class="options_details">
                  <div class="options_icons">
                    <input type="radio" name="role" id="supplier" class="radio_options" value="supplier"/>
                  </div>
                  <h6>I'm a Supplier</h6>
                </div>
              </div>
              <div class="apply-btn text-center">
              <button type="submit" id="choose-profession">Join Digital Farm Nepal Family as a <span id="profession">Farmer</span></button>
              </div>
              <div class="switch-btn text-center mt-3">
                <p>Already Have an account? <a href="user_login.php">Login</a></p>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      // pre register
var options = document.querySelectorAll(".options_details");
var radioOptions = document.querySelectorAll(".radio_options");
const role = ["Farmer", "Consumer", "Vendor","Supplier"];
const chooseProfession = document.getElementById("choose-profession");

for (i = 0; i < radioOptions.length; i++) {
  radioOptions[i].addEventListener("click", activeOption);
}
function activeOption() {
  for (i = 0; i < radioOptions.length; i++) {
    if (radioOptions[i].checked) {
      options[i].classList.add("active");
      var profession = document.getElementById("profession");
      profession.innerHTML = role[i];
      // chooseProfession.setAttribute('name',role[i]);
      chooseProfession.disabled = false;
    } else {
      options[i].classList.remove("active");
      // chooseProfession.disabled = true;
    }
  }
}
    </script>
     <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    <script src="../js/index.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
  </body>
</html>

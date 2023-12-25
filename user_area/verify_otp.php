<?php
include('../includes/connect.php');
session_start();
$ot = $_SESSION['otp'];
echo $ot;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #79bb6f;
        }

        .height-100 {
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .card h6 {
            color: green;
            font-size: 20px
        }

        .inputs input {
            width: 80%;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: green
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid green
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: green;
            border: 1px solid green;
            width: 140px
        }
    </style>
</head>

<body>
    <?php
    if(isset($_SESSION['otp_email']) and isset($_SESSION['otp'])){
    if (isset($_POST['send_otp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $inputOtp = $_POST['otp'];
            $email = $_SESSION['otp_email'];
            $otp = $_SESSION['otp'];
            //verify_otp
            $sel = mysqli_query($con, "Select otp from `user_table` where email='$email' and otp=$otp");
            $num_rows = mysqli_num_rows($sel);
            if ($num_rows > 0) {
                $otp_result = mysqli_fetch_assoc($sel);
                $user_otp = $otp_result['otp'];
                if ($inputOtp === $user_otp) {
                    $update = mysqli_query($con,"Update `user_table` set `verify_status`=1 WHERE  email='$email' and otp='$otp'");
                    if($update){
                        echo "<script>alert('Register Successful..')</script>";
                        echo "<script>window.open('./user_login.php','_self')</script>";
                        unset($_SESSION['otp_email']);
                        unset($_SESSION['otp']);
                        unset($_SESSION['user']);
                    }
                }else{
                    echo "<h3 style='position:absolute; top: 5rem; width:100%;'><span class='d-block m-auto text-center text-danger'>OTP not matched.</span></h3>";
                }
            }
        }
        if (isset($_POST['resendOtp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            unset($_SESSION['otp']);
            $otp = rand(19999, 99999);
            // $user_name = $_SESSION['name'];
            $user_email = $_SESSION['otp_email'];
            $update_query = "Update `user_table` set `otp`=$otp where email=$user_email" ;
            $sql_execute = mysqli_query($con, $update_query);
                if ($sql_execute) {
                    // $_SESSION['otp_email'] = $user_email;
                    $_SESSION['otp'] = $otp;
                    sendEmail("", "$user_email", "$otp");
                    echo "<script>alert('OTP sent successful');</script>";
                    echo "<script>window.open('./verify_otp.php','_self')</script>";
                }
                else{
                    echo "<script>alert('Otp unsuccessful!');</script>";
                }
            }
    
    ?>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <h6>Please enter the OTP code <br> to verify your account</h6>
                <div> <span>A code has been sent to</span> <small class="text-success fw-bold"><?php echo $_SESSION['otp_email']; ?></small> </div>
                <form action="" method="post">
                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                    
                    <input class="m-2 text-center form-control rounded" type="number"  name="otp" required />
                
                </div>
                <div class="mt-4"> <button class="btn btn-danger px-4 validate" name="send_otp">Validate</button>
                </div>
                </form>
            </div>
            <div class="card-2">
                <div class="content d-flex justify-content-center align-items-center"> <span>Didn't get the code </span>
                    <form action="" method="post">
                        <button type="submit" name="resendOtp">Resend</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php }
    else{
        header("Location: user_login.php");
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>
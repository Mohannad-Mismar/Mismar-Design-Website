<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>log in</title>
   
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }
        
        body {
            background:rgb(0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.logo img {
    max-width: 180px;
    height: auto;
    display: block;
}


        .container {
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 30px 40px;
            padding-top: 20px;
            padding-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(250, 250, 250, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
            color: #333;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        
        p {
            text-align: center;
            color: #777;
            margin-bottom: 20px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 25px;
        }
        
        .options a {
            text-decoration: none;
            color: #007bff;
        }
        
        button {
            width: 100%;
            padding: 12px;
            padding-top: 10px;
            background-color:rgb(0, 0, 0);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color:rgb(15, 71, 0);
        }
        
        .divider {
            text-align: center;
            margin: 20px 0;
            color: #aaa;
            position: relative;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            background: #ddd;
            width: 40%;
            position: absolute;
            top: 50%;
        }
        
        .divider::before {
            left: 0;
        }
        
        .divider::after {
            right: 0;
        }
        
        .social {
            background: #dd4b39;
            margin-bottom: 10px;
        }
        
        .terms {
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .bottom-text {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }
        
        .bottom-text a {
            color: #007bff;
            cursor: pointer;
            text-decoration: none;
        }
        
        #signupForm {
            display: none;
        }
       
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
  <img src="./images/mismar-logo.png" alt="Mismar Design Logo" />
</div>


        <!-- Sign In Form -->
        <form id="signinForm" action="loginS.php" method="POST">
            <h2>Welcome Back</h2>
            <p>Please sign in to your account</p>

            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />

            <div class="options">
                <label><input type="checkbox" /> Remember me</label>
                <a onclick="toggleForms('reset')">Forgot Password?</a>
            </div>

            <button  type="submit">Sign In</button>
           
            <p class="bottom-text">Don't have an account? <a onclick="toggleForms('signUp')">Sign up</a></p>
        </form>
        
<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
    echo "<script>alert('wrong email or password');</script>";
    echo "<script>window.location.href='login.php';</script>";
}



if (isset($_GET['reset'])) {
    switch ($_GET['reset']) {
        case 'sent':
            echo "<script>alert('Password reset email sent');</script>";
            break;
        case 'invalid':
            echo "<script>alert('Email not found');</script>";
            break;
        case 'success':
            echo "<script>alert('Password updated successfully');</script>";
            break;
        case 'error':
            echo "<script>alert('Error sending email. Please try again later.');</script>";
            break;
    }
}


?>
        <!-- Sign Up Form -->
        <form id="signupForm" action="signup.php" method="POST" onsubmit="return validatePassword()">
            <h2>Create Account</h2>
            <p>Sign up to get started</p>

            <input type="email" name="email" placeholder="Email" required />
            <input id="ps" type="password" name="password" placeholder="Password" required  />
            <input id="psc" type="password" name="confirm_password" placeholder="Confirm Password" required  />


            <button id="signUp" type="submit" onclick="pA()">Sign Up  </button>

            

            <p class="bottom-text">Already have an account? <a onclick="toggleForms('signIn')">Sign in</a></p>
        </form>

<form id="forgotPasswordForm" action="forgot_password.php" method="POST" style="display:none;">
    <h2>Reset Password</h2>
    <p>Enter your email to reset password</p>
    
    <input type="email" name="email" placeholder="Email" required />
    
    <button type="submit">Reset Password</button>
    
    <p class="bottom-text">Remember your password? 
        <a onclick="toggleForms('signIn')">Sign in</a>
    </p>
</form>
    </div>

    <script>
        function toggleForms(formName) {
           const signIn = document.getElementById("signinForm");
    const signUp = document.getElementById("signupForm");
    const reset = document.getElementById("forgotPasswordForm");

    // Hide all forms
    signIn.style.display = "none";
    signUp.style.display = "none";
    reset.style.display = "none";

    // Show the selected form
    if (formName === "signIn") {
        signIn.style.display = "block";
    } else if (formName === "signUp") {
        signUp.style.display = "block";
    } else if (formName === "reset") {
        reset.style.display = "block";
    }
          
        }
        function validatePassword() {
    const password = document.getElementById('ps').value;
    const confirmPassword = document.getElementById('psc').value;
    
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return false;
    }
    return true;
}
    </script>
</body>

</html>
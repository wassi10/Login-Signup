<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['con_password']);
   $user_type = $_POST['user_type'];

   $select_sql = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select_sql);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User Already Exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'Password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f65800a99.js" crossorigin="anonymous"></script>
 
    
</head>
<body>
    <div class="form-container">
        <form action="" method = "post">
            <h3>Sign Up</h3>

            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                };
            ?>
          
            
           <div class="input-field">
           <i class="fa-solid fa-user"></i>
            <input type="text" name="name" placeholder="Name" required>
           </div>

           <div class="input-field">
           <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
           </div>

           <div class="input-field">
           <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
           </div>

           <div class="input-field">
           <i class="fa-solid fa-fingerprint"></i>
            <input type="password" name="con_password" placeholder="Confirm Password" required>
           </div>
            
           <div class="input-field">
           <select name="user_type" >
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
           </div>

            <input type="submit" name="submit" value="Sign Up" class="form-btn">
            <p>Already have an Account? <a href="login.php">Login Now</a></p>

        </form>
    </div>
</body>
</html>
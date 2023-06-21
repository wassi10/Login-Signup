<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);


   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f65800a99.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method = "post">
            <h3>Sign In</h3>
            
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                };
            ?>

        <div class="input-field">
           <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
           </div>

           <div class="input-field">
           <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
           </div>

            <input type="submit" name="submit" value="Sign In" class="form-btn">
            <p>Don't have an Account? <a href="index.php">Sign Up</a></p>
        </form>
    </div>
</body>
</html>
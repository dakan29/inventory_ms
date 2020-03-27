<?php
require 'config.php';
require 'header.php';

//variables to store data from forms
$username = $email = $password1 = $password2 = $user_type = '';

//variables to store error messages
$password1_err= $password2_err= $username_err = $email_err = '';

//check request method and start grabbing data from form

if (isset($_POST['btn_signup'])){

    if (isset($_POST['username'])){
        $username = $_POST['username'];
    }else{
        $username_err = 'Please fill this field';
    }

    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $email_err = 'Please fill this field';
    }

    if (isset($_POST['password1'])){
        $password1 = $_POST['password1'];
    }else{
        $password1_err = 'Please fill this field';
    }

    if (isset($_POST['password2'])){
        $password2 = $_POST['password2'];
    }else{
        $password2_err = 'Please fill this field';
    }

    if (isset($_POST['user-type'])){
        $user_type = $_POST['user-type'];
    }

    //check if passwords match
    if ($password1 != $password2){
        $password2_err = 'Oops! Your passwords do not seem to match';
    }else{
        //check if user exists
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        //results from db
        $results = mysqli_query($conn,$sql);
        if (mysqli_num_rows($results) > 0){
            //user exists, go to login page
            header("location:login.php");
            exit();
        }

        //hash password
        $password1 = md5($password1);

        //add user to database
        $sql = "INSERT INTO `users`(`id`, `username`, `email`, `password`, `user_type`) VALUES (NULL ,'$username','$email','$password1','$user_type')";

        if (mysqli_query($conn,$sql)){
            //take user to login
            header("location:login.php");
            exit();
        }else{
            echo "Data not added: " . mysqli_error($conn) . "$sql<br>";
        }

    }
}

function cleanData($data){
    $data = trim($data); //remove whitespaces
    $data = stripslashes($data); //remove slashes
    $data = htmlspecialchars($data); //remove html special characters

    return $data;
}
?>

    <!-- Signup form -->

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3"></div>
            <div class="col-md- col-lg-6 col-xl-6">
                <div class="form-section">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password1" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password2" class="form-control" required>
                            </div>
                            <div class="input-group">
                            <span>
                                GSO Staff <input type="radio" name="user-type" value="GSO Staff">
                            </span>
                                <span>
                                Other Staff <input type="radio" name="user-type" value="Other Staff" checked>
                            </span>
                            </div>
                            <button class="button btn btn-warning btn-block" name = "btn_signup">Create Account</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3"></div>
        </div>
    </div>

<?php
require 'footer.php';
?>
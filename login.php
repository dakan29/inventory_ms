<?php
require 'config.php';
require 'header.php';

$email = $password = '';
$email_err = $password_err = '';

//check request method and start grabbing data from form

if (isset($_POST['btn-login'])){

    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }else{
        $email_err = 'Please fill this field';
    }

    if (isset($_POST['password'])){
        $password = $_POST['password'];
    }else{
        $password_err = 'Please fill this field';
    }

    //check if user exists

    //hash password
    $password = md5($password);

    $sql = "SELECT `id`, `username`, `email`, `password`, `user_type` FROM `users` WHERE email='$email' AND password='$password'";

    //results from db
    $results = mysqli_query($conn,$sql);

    if (mysqli_num_rows($results) > 0){
        // get individual data about the user from the db
        while ($rows = mysqli_fetch_assoc($results)){
            $id = $rows['id'];
            $email = $rows['email'];

            //create session for user
            session_start();
            $_SESSION['kipande'] = $id;
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_user = $rows['user_type'];
            if ($_user == 'supplier') {
                $_SESSION['aina_ya_mtumizi'] = true;
            }else{
                $_SESSION['aina_ya_mtumizi'] = false;

            }


            //return user to index page

            header("location:index.php?msg_login");
            exit();
        }

    }else{
        //wrong password or email
        header("location:signup.php");
    }

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
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button class="button btn btn-warning btn-block" name = "btn-login">Login</button>
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
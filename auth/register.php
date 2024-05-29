<?php
require '../config/config.php';

$errMsg = '';

if(isset($_POST['register'])) {
    // Server-side input sanitization
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Password matching validation
    if($password !== $c_password) {
        $errMsg = 'Passwords do not match';
    } else {
        // Password complexity validation
        if(strlen($password) < 8 || !preg_match("/\d/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/\W/", $password)) {
            $errMsg = 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
        } else {
            // Mobile number validation
            if($mobile < 9800000000 || $mobile > 9899999999) {
                $errMsg = 'Mobile number should be between 9800000000 and 9899999999';
            } else {
                try {
                    $stmt = $connect->prepare('INSERT INTO users (fullname, mobile, username, email, password) VALUES (:fullname, :mobile, :username, :email, :password)');
                    $stmt->execute(array(
                        ':fullname' => $fullname,
                        ':username' => $username,
                        ':password' => md5($password),
                        ':email' => $email,
                        ':mobile' => $mobile,
                    ));
                    $_SESSION['successMsg'] = 'Registration successful. Now you can login';
                    header('Location: register.php');
                    exit;
                }
                catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }
		}
    }
}

if(isset($_GET['action']) && $_GET['action'] == 'joined') {
    $errMsg = isset($_SESSION['successMsg']) ? $_SESSION['successMsg'] : '';
    unset($_SESSION['successMsg']); // Clear the message after displaying
}
?>

<?php include '../include/header.php';?>

<!-- Services -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php">Room-Recommendation-System</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="register.php">Register</a> -->
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- <section> --><br>
<div class="container">
    <div class="row">                
        <div class="col-md-8 mx-auto">
            <div class="alert alert-dark" role="alert">
                <?php
                if(isset($errMsg)){
                    echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
                }
                ?>
                <h2 class="text-center">Register</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control" id="username" placeholder="User Name" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="tel" class="form-control" id="mobile"  title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-6">                      
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" >
                    </div>

                    <div class="form-group">
                        <label for="c_password">Confirm Password</label>
                        <input type="password" class="form-control" id="c_password" placeholder="Confirm Password" name="c_password" >
                    </div>
                    <div class="d-flex justify-content-center ">
                    <button type="submit" class="btn btn-secondary btn-lg btn-block" name='register' value="register">Submit</button>
                    </div>
                </form>
                <div class="text-sm-center  mt-3 ">
                   Already have an account?<a href="login.php"> Login here</a>
                </div>             
            </div>
        </div>
    </div>
</div>
<!-- </section> -->
<?php include '../include/footer.php';?>

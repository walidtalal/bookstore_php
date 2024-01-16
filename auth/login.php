
<?php include "../includes/header.php"?>
<?php include "../config/config.php"?>

<?php

if(isset($_SESSION['username'])) {
    header("location: ".APPURL."");
}

if(isset($_POST['submit'])) {
    if(empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('one or more input is empty')</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "select * from users where email = :email";
        $login = $conn->prepare($query);
        $login->execute([':email'=>$email]);

        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0) {
            if(password_verify($password, $fetch['password'])) {
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['user_id'] = $fetch['id'];
                header("location: ".APPURL."");
            } else {
                echo "<script>alert('Password or email is invalid')</script>";
            }
        } else {
            echo "<script>alert('Password or email is invalid')</script>";

        }


    }
}

?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="form-control mt-5" method="post" action="login.php">
                    <h4 class="text-center mt-3"> Login </h4>
                   
                    <div class="">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="">
                            <input type="email" name="email"  class="form-control" id="" value="">
                        </div>
                    </div>
                    <div class="">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="">
                            <input type="password" name="password" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-4" name="submit" type="submit">login</button>

                </form>
            </div>
        </div>



<?php include "../includes/footer.php"?>

<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"; ?>
<?php

if(isset($_POST['submit'])) {
if(empty($_POST['adminname']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alert('one or more input is empty')</script>";

} else {

}
    $email = $_POST['email'];
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];

    $insert = $conn->prepare("insert into admins (email, adminname , password) values (:email, :adminname, :password)");
    $insert->execute([
            ":email"=> $email,
            ":adminname"=> $adminname,
            ":password"=> password_hash($password, PASSWORD_DEFAULT),
    ]);

    header("location: ".ADMINURL."/admins/admins.php");
}


?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                    <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php" ?>

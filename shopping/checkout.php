<?php include "../includes/header.php" ?>
<?php include "../config/config.php" ?>

<?php


if(!isset($_SESSION['username'])) {
    header("location: ".APPURL."");
}



if(isset($_POST['submit'])) {
    if(empty($_POST['email']) OR empty($_POST['username']) OR empty($_POST['fname'])
        OR empty($_POST['lname'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $price = $_SESSION['price'];
        $token = "asdfvbgbsdfv";
        $user_id = $_SESSION['user_id'];

        $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, token, price, user_id)
        VALUES(:email, :username, :fname, :lname, :token, :price, :user_id)");

        $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':fname' => $fname,
            ':lname' => $lname,
            ':token' => $token,
            ':price' => $price,
            ':user_id' => $user_id,
        ]);

//        header("location: ".APPURL."/download.php");
        header("location: pay.php");


    }

}


?>

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Checkout</h2>
<?php echo $_SESSION['price']?>
      <!--Grid row-->
      <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" method="post"  action="checkout.php">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form">
                    <label for="firstName" class="">First name</label>

                    <input type="text" name="fname" id="firstName" class="form-control">
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->
                  <div class="md-form">
                    <label for="lastName" class="">Last name</label>

                    <input type="text" name="lname" id="lastName" class="form-control">
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="md-form mb-5">
                <label for="email" class="">Username</label>

                <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <label for="email" class="">Email (optional)</label>

                <input type="email" name="email" id="email" class="form-control" placeholder="youremail@example.com">
              </div>

              <!--address-->
<!--              <div class="md-form mb-5">-->
<!--                <label for="address" class="">Address</label>-->
<!---->
<!--                <input type="text" id="address" class="form-control" placeholder="1234 Main St">-->
<!--              </div>-->

             
              <!--Grid row-->
<!--              <div class="row">-->
<!---->
<!--              -->
<!---->
                <!--Grid column-->
<!--                <div class="col-lg-4 col-md-6 mb-4">-->
<!---->
<!--                <select class="form-select" aria-label="Default select example">-->
<!--                  <option selected>Choose City</option>-->
<!--                  <option value="1">London</option>-->
<!--                  <option value="2">Berlin</option>-->
<!--                  <option value="3">Cairo</option>-->
<!--                </select>-->
<!---->
<!--                </div>-->
                <!--Grid column-->
<!---->
                <!--Grid column-->
<!--                <div class="col-lg-4 col-md-6">-->
<!---->
<!--                  <input type="text" placeholder="Zip Code" class="form-control" id="zip" placeholder="" required>-->
<!--                  <div class="invalid-feedback">-->
<!--                    Zip code required.-->
<!--                  </div>-->
<!---->
<!--                </div>-->
                <!--Grid column-->
<!---->
<!--              </div>-->
              <!--Grid row-->

            
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Continue to checkout</button>
<!--                <script-->
<!--                        src="https://checkout.stripe.com/checkout.js"-->
<!--                        class="stripe-button"-->
<!--                        data-key="pk_test_51OhHEaCXHJ4JBkis2P4QyeJCjDqOHC12Eyf1wDiQjCXR1TjsFqvdvJdjwdRd32ZebddkUv97Tru8u3eCx3CY7Dhm00zX7NO5pI"-->
<!---->
<!--                        data-currency="usd"-->
<!--                        data-label="pay now"-->
<!--                >-->
<!--                </script>-->
            </form>

          </div>
         
        </div>
    </div>

<?php include "../includes/footer.php" ?>

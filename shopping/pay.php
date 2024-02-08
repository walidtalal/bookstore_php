<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>

<?php
/* at the top of 'check.php' */
if($_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

    /* choose the appropriate page to redirect users */
    die( header( 'location: '.APPURL.'' ));

}

if(!isset($_SESSION['user_id'])) {
    header("location: ".APPURL."");
}
?>

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url(<?php echo APPURL?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Pay with Paypal</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL?>">Pay with Paypal</a></span> <span>Checout</span></p>
                    </div>



                </div>
            </div>
        </div>


    </section>
    <div class="container">
        <!-- Replace "test" with your own sandbox Business account app client ID -->
        <script src="https://www.paypal.com/sdk/js?client-id=AXN3-842aCO9XW8KmvlMj-mVRIr1EkDBDli4SlTk8ygKAwFC8XGnKM-5g-DreLlaY9YYXbQrHxtvliBT&currency=USD"></script>
        <!-- Set up a container element for the button -->
        <div id="paypal-button-container"></div>
        <script>
            paypal.Buttons({
                // Sets up the transaction when a payment button is clicked
                createOrder: (data, actions) => {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '<?php echo $_SESSION['price'];?>' // Can also reference a variable or function
                            }
                        }]
                    });
                },
                // Finalize the transaction after payer approval
                onApprove: (data, actions) => {
                    return actions.order.capture().then(function(orderData) {
                        window.location.href='<?php echo APPURL."/download.php"?>';

                        // header("location: ".APPURL."/download.php");

                    });
                }
            }).render('#paypal-button-container');
        </script>

    </div>

    <!--            </div>-->
    <!--            </div>-->

<?php include_once '../includes/footer.php'?>
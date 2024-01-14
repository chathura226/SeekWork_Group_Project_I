<?php $this->view('company/company-header', $data) ?>
<link href="<?= ROOT ?>/assets/css/checkout.styles.css" rel="stylesheet">
<link href="<?= ROOT ?>/assets/css/post-task.styles.css" rel="stylesheet">


<div class="pagetitle column-12">
    <h1>Payment Details</h1>
    <nav>

        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>" class="breadcrumbs__link">Home</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>" class="breadcrumbs__link">Dashboard</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="<?= ROOT ?>/<?= Auth::getrole() ?>/payments" class="breadcrumbs__link">Payments</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link breadcrumbs__link--active">Payment Details</a>
            </li>
        </ul>
    </nav>
</div><!-- End Page Title -->


<div class="form-wrap column-12" style="height: 1000px; !important;">
    <div class="tab-form row-4">

        <div class="myheader">
            <div class="active-login"><h2>Payment Details</h2></div>
        </div>
        <div class="tab-body">
            <div class="active1">
                <form id="checkout-form" method="post" action="https://sandbox.payhere.lk/pay/checkout">

                    <input type="hidden" name="merchant_id" value="<?= $merchantID ?>">
                    <!-- Replace your Merchant ID -->
                    <input type="hidden" name="return_url" value="<?= ROOT ?>/company/payments">
                    <input type="hidden" name="cancel_url" value="<?= ROOT ?>/company/payments">
                    <input type="hidden" name="notify_url"
                           value="https://17a7-212-104-237-129.ngrok-free.app/public/payment">

                    </br>
                    <h3>Item Details</h3>
                    <hr>

                    <div class="form-input">
                        <label>Payment ID</label>
                        <input type="text" name="order_id" value="<?= $order_id ?>" readonly>

                    </div>
                    <div class="form-input">
                        <label>Description</label>
                        <input type="text" name="items" value="<?= $items ?>" readonly>

                    </div>

                    <div class="form-input">
                        <label>Currency</label>
                        <input type="text" name="currency" value="<?= $currency ?>" readonly>

                    </div>
                    <div class="form-input">
                        <label>Amount</label>
                        <input type="text" name="amount" value="<?= $amount ?>" readonly>

                    </div>

                    </br>
                    <h3>Your Details</h3>
                    <hr>
                    <div class="form-input">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="<?= $first_name ?>" readonly>
                    </div>
                    <div class="form-input">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="<?= $last_name ?>" readonly>
                    </div>
                    <div class="form-input">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $email ?>" readonly>
                    </div>
                    <div class="form-input">
                        <label>Contact No.</label>
                        <input type="text" name="phone" value="<?= $phone ?>" readonly>
                    </div>

                    <div class="form-input">
                        <label>Address</label>
                        <input type="text" name="address" value="<?= $address ?>" readonly>
                    </div>

                    <input type="hidden" name="city" value="Colombo">
                    <input type="hidden" name="country" value="<?= $country ?>">
                    <input type="hidden" name="hash" value="<?= $hash ?>">    <!-- Replace with generated hash -->


                    <div class="form-input">
                        <div class="checkout-container" onclick="submitForm()">
                            <div class="checkout-left-side">
                                <div class="checkout-card">
                                    <div class="checkout-card-line"></div>
                                    <div class="checkout-buttons"></div>
                                </div>
                                <div class="checkout-post">
                                    <div class="checkout-post-line"></div>
                                    <div class="screen">
                                        <div class="dollar">$</div>
                                    </div>
                                    <div class="numbers"></div>
                                    <div class="numbers-line2"></div>
                                </div>
                            </div>
                            <div class="checkout-right-side">
                                <div class="new">Checkout</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<script>
    function submitForm() {
        document.getElementById("checkout-form").submit();
    }
</script>


<?php $this->view('company/company-footer', $data) ?>


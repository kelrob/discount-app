<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/styles/style.css') }}" />
    <title>DISCOUNT ASSESMENT</title>

    <!-- load jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <h3 id="logo" class="font-weight-bold text-grey">DISCOUNT ASSESSMENT</h3>
                <p class="font-weight-bold" id="text-accent">Please reload the page for new results</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12" id="cart-header">
                        <h5>YOUR CART (<span id="product_count">{{ $count }}</span>)</h5>
                    </div>
                </div>

                @foreach ($products as $product)
                    <div class="row mt-3 border-bottom pb-3">
                        <div class="col-lg-2">
                            <img src="https://via.placeholder.com/150" class="img-fluid" />
                        </div>
                        <div class="col-lg-10" id="product-details">
                            <h6>{{ $product->name }}</h6>
                            <h6 class="mt-3">${{ number_format($product->price) }}.00</h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-4 p-3 bg-secondary">
                <h5 class="text-white">SUMMARY</h5>

                <form class="mt-4">
                    <div class="form-group">
                        <div class="col-lg-12 p-0 m-0">
                            <label for="coupon_code">Enter Coupon Code</label>
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control">
                            <button onclick="validateCouponCode()" type="button"
                                class="btn btn-primary btn-sm mt-1">Validate</button>
                            <p><small class="text-warning font-weight-bold" id="response"></small></p>
                        </div>
                    </div>
                    <div class="form-group text-center mt-5 text-white">
                        <p class="p-0 m-0">TOTAL</p>
                        <h3 class="pt-0 mt-0 font-weight-bold" id="total">${{ number_format($total) }}.00</h3>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="checkout-btn"> CHECKOUT &rarr;</button>
                    </div>

                    <p class="mt-3 text-center font-weight-bold"><small>Coupon codes are not case sensitive</small></p>
                    <p>
                        <u>COUPON CODES</u> <br />
                        <b>FIXED10</b> <br />
                        <b>PERCENT10</b> <br />
                        <b>MIXED10</b> <br />
                        <b>REJECTED10</b>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- CUSTOM JAVASCRIPT -->
    <script>
        const validateCouponCode = () => {

            let couponCode;

            // Current total
            let total = {
                {
                    $total
                }
            }

            // Product Count
            let productCount = {
                {
                    $count
                }
            }

            // Set default value of coupon to 0
            if ($('#coupon_code').val().trim() == '') {
                return alert('Please Enter a Coupon Code');
            } else {
                couponCode = $('#coupon_code').val();
            }


            // Hide total to get ne total
            $('#total').html('Calculating Price');

            // Validate Coupon code entered
            $.ajax({
                type: 'GET',
                url: `/validate-coupon-code/${couponCode}/${total}/${productCount}`,
                success: function(data) {
                    if (data.status == false) {
                        $('#response').html(data.message).show();
                        $('#total').show().html(`$ ${total.toLocaleString()}.00`);
                    } else if (data.status == true) {
                        $('#response').hide();
                        $('#total').show().html(`$ ${data.amount.toLocaleString()}.00`);
                    }

                    console.log(data);
                }
            });
        }

    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>

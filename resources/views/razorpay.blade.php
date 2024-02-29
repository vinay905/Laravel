<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    {{session()->flush()}}
    <script>
        setTimeout(function () {
            window.location.href = "{{route('home')}}"
        }, 5000); // 2 second
    </script>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-error">
        {{ session()->get('error') }}
    </div>
    {{session()->flush()}}
    @endif
    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_API_KEY') }}"
            data-amount="45600" 
            data-buttontext="Pay Amount" 
            data-name="Laravel"
            data-notes.customer_name="Vinay Singh" 
            data-description="A demo razorpay payment"
            data-prefill.name="Vinay Singh"
            data-image="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png"
            data-notes.customer_email="vinaysinghworkspace@gmail.com" 
            data-notes.product_name="Laptop"
            data-notes.quantity="1"
            >
            </script>
    </form>
</body>

</html>

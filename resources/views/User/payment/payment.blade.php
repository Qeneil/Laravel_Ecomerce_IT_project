<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }
    </style>
    <!-- Include Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="#" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
    </nav>

    <div class="content container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6 text-center">Payment</h1>

        <!-- Payment Method -->
        <div class="text-center mb-6">
            <p class="text-gray-700">Please complete your payment below:</p>
            <form action="{{ route('payments') }}" method="POST" id="payment-form">
                @csrf
                <div class="mb-4">
                    <label for="card-element" class="block text-gray-700">Credit or debit card</label>
                    <div id="card-element" class="border p-3 rounded"></div>
                    <div id="card-errors" role="alert" class="text-red-500 mt-2"></div>
                </div>
                <div class="flex justify-center">
                    <button id="submit" class="bg-blue-500 text-white py-2 px-4 rounded" type="submit">Pay Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer Navigation -->
    <footer class="bg-gray-200 py-12">
        <div class="max-w-6xl mx-auto text-center space-y-6">
            <div class="text-lg font-bold">DP STORE</div>
            <p class="text-gray-600">Secure Payment | Delivered With Care | Excellent Service</p>
            <div class="flex justify-center space-x-6">
                <a href="#" class="hover:text-blue-500">HOME</a>
                <a href="#" class="hover:text-blue-500">ABOUT</a>
                <a href="#" class="hover:text-blue-500">SHOP</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a>
            </div>
            <div class="text-sm text-gray-500">© 2024 Technology DP Store</div>
        </div>
    </footer>

    <!-- Include the JavaScript file -->
    <script src="{{ asset('admin-asset/JavaScript/script.js') }}" defer></script>

    <script>
        // Set up Stripe.js and Elements to use in checkout form
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        var card = elements.create('card', {
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle form submission
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            console.log('Form submitted'); // Log when the form is submitted

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    console.log('Error:', result.error.message); // Log the error message
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the Stripe token
        function stripeTokenHandler(token) {
            var paymentForm = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            paymentForm.appendChild(hiddenInput);

            // ใช้ HTMLFormElement.submit() เพื่อส่งฟอร์ม
            HTMLFormElement.prototype.submit.call(paymentForm);
        }

        // Log the Stripe public key
        console.log('Stripe Key:', '{{ env('STRIPE_KEY') }}');
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->product_name }} - DP Store</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="{{ url('/') }}" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="{{ route('mainshop') }}" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
        <div class="flex space-x-4 relative">
            <a href="" class="no-underline">
                <img src="{{ asset('admin-asset/images/cart.svg') }}" alt="Shopping Cart Icon" class="w-7 h-7">
            </a>
        </div>
    </nav>

<!-- Product Details Section -->
<section class="max-w-6xl mx-auto py-10">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Image -->
            <div>
                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="w-full h-auto rounded mb-4">
            </div>

            <div>
                <h1 class="text-lg font-bold text-gray-800 text-center">{{ $product->product_name }}</h1>
                <p class="text-red-500 text-xl font-semibold text-center mt-1">{{ number_format($product->price, 2) }} Baht</p>
                <p class="text-gray-600 text-center mt-1">{{ $product->description }}</p>

                <div class="flex items-center justify-center mt-2">
                    <label for="quantity" class="text-sm font-medium mr-2">Quantity:</label>
                    <input type="number" id="quantity" value="1" min="1" class="border border-gray-300 rounded py-1 px-2 text-gray-700 w-16">
                </div>

                <div class="mt-3 flex justify-center space-x-2">
                    <button type="button" class="bg-black text-white py-1 px-2 rounded hover:bg-gray-700 w-full max-w-xs">
                        Add to Cart
                    </button>
                    <button type="button" class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 w-full max-w-xs">
                        Buy Now 
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>



















        <!-- Related Products Section -->
<h2 class="text-2xl font-semibold mt-10">Related Products</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    @foreach ($relatedProducts as $related)
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <a href="{{ route('ProductDetails', $related->product_id) }}"> <!-- ใช้ product_id -->
                <img src="{{ asset($related->image) }}" alt="{{ $related->product_name }}" class="w-full h-auto mb-4 rounded-lg">
                <h3 class="text-xl font-bold mb-2">{{ $related->product_name }}</h3>
                <p class="text-gray-600">{{ number_format($related->price, 2) }} Baht</p>
            </a>
        </div>
    @endforeach
</div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-200 py-12">
        <div class="max-w-6xl mx-auto text-center space-y-6">
            <div class="text-lg font-bold">DP STORE</div>
            <p class="text-gray-600">Secure Payment | Delivered With Care | Excellent Service</p>
            <div class="text-sm text-gray-500">© 2024 Technology DP Store</div>
        </div>
    </footer>

    <!-- Include the JavaScript file -->
    <script src="{{ asset('admin-asset/JavaScript/script.js') }}"></script>

</body>

</html>

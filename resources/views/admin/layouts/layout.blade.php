<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DP Store - Dashboard</title>
    <meta name="description"
        content="DP Store offers a variety of IT equipment at competitive prices with excellent customer service. Shop now!">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <header class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <nav>
            <ul class="flex space-x-6">
                <li class="nav-item"><a href="{{ route('admin') }}" class="hover:text-blue-500">HOME</a></li>
                <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
                <li class="nav-item"><a href="" class="hover:text-blue-500">SHOP</a></li>
                <li class="nav-item"><a href="" class="hover:text-blue-500">CONTACT</a></li>
            </ul>
        </nav>
        <div class="flex space-x-4 relative">
            <a href="#" class="no-underline">
                <img src="{{ asset('admin-asset/images/cart.svg') }}" alt="Shopping Cart" class="w-7 h-7">
            </a>
            <!-- Logout Icon -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="text-gray-800 hover:text-red-500" title="Logout">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h12v16H6V4zm4 10h4m-4-4h4" />
        </svg>
    </button>
</form>


        </div>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="text-center bg-white py-16">
            <h1 class="text-4xl font-bold mb-4">DP</h1>
            <p class="text-xl text-gray-600 mb-6">IT EQUIPMENT STORE</p>
            <a href="{{ route('mainshop') }}" class="bg-blue-600 text-white py-3 px-6 rounded-full hover:bg-blue-500 transition">SHOP NOW</a>
        </section>

        <!-- Products Section -->
        <section class="py-16 bg-gray-100">
            <h2 class="text-3xl font-semibold text-center mb-12">Interesting Products</h2>
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Product Cards -->
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <img src="{{ asset('admin-asset/images/Product/ga403uu.svg') }}" alt="Asus ROG Zephyrus G14" class="w-full mb-4 rounded">
                    <h3 class="text-xl font-bold mb-2">Asus ROG Zephyrus G14</h3>
                    <p class="text-gray-600">57,900 Baht</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <img src="{{ asset('admin-asset/images/Product/PlayStation-5.svg') }}" alt="Sony PlayStation 5" class="w-full mb-4 rounded">
                    <h3 class="text-xl font-bold mb-2">Sony PlayStation 5</h3>
                    <p class="text-gray-600">15,690 Baht</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <img src="{{ asset('admin-asset/images/Product/Galaxy-A15.svg') }}" alt="Samsung Galaxy A15" class="w-full mb-4 rounded">
                    <h3 class="text-xl font-bold mb-2">Samsung Galaxy A15</h3>
                    <p class="text-gray-600">5,490 Baht</p>
                </div>
            </div>
        </section>

        <!-- Customer Testimonials Section -->
        <section class="py-16 bg-white">
            <h2 class="text-3xl font-semibold text-center mb-12">What Our Customers Say</h2>
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <!-- Testimonial Cards -->
                <div class="p-6 rounded-lg bg-gray-50">
                    <p class="italic mb-4">This website is straightforward to use. I can find the products I want easily
                        and the purchase process is simple. Don’t waste time!</p>
                    <div class="text-gray-800 font-bold">Sonchai Phatthanarak</div>
                </div>
                <div class="p-6 rounded-lg bg-gray-50">
                    <p class="italic mb-4">I like that this website has complete and detailed product information,
                        making purchasing decisions easier!</p>
                    <div class="text-gray-800 font-bold">Anchanee Nanitdet</div>
                </div>
                <div class="p-6 rounded-lg bg-gray-50">
                    <p class="italic mb-4">There are a variety of products and good prices. The customer service is also
                        excellent. I had a question, and the support team solved it immediately!</p>
                    <div class="text-gray-800 font-bold">Wisarut Chatchai</div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-200 py-12">
        <div class="max-w-6xl mx-auto text-center space-y-6">
            <div class="text-lg font-bold">DP STORE</div>
            <p class="text-gray-600">Secure Payment | Delivered With Care | Excellent Service</p>
            <div class="text-sm text-gray-500">© 2024 Technology DP Store</div>
        </div>
    </footer>

    <!-- Include the JavaScript file -->
    <script src="{{ asset('admin-asset/js/script.js') }}"></script>
</body>

</html>

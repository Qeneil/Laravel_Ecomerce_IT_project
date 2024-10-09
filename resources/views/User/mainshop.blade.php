<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop - DP Store</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
        <div class="flex space-x-4 relative">
            <a href="#" class="no-underline">
                <img src="{{ asset('admin-asset/images/cart.svg') }}" alt="Shopping Cart Icon" class="w-7 h-7">
            </a>
            <!-- Dropdown Button -->
            <button id="dropdownInformationButton"
                class="text-gray-800 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center dark:text-white"
                type="button">
                <span>User Test</span>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownInformation"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div>Test Beta</div>
                    <div class="font-medium truncate">user@gmail.com</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Profile</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Orders</a>
                    </li>
                    <li>
                        <a href="/html/Dashboard.html" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                </ul>
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Login</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="max-w-6xl mx-auto py-10">
    <form action="{{ route('mainshop') }}" method="GET" class="flex justify-between items-center mb-8">
    <div>
        <select name="category" class="border border-gray-300 rounded-lg py-2 px-4 text-gray-700">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->category_name }} <!-- แสดงชื่อประเภท -->
                </option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500">Filter</button>
    </div>
    <div>
        <input type="text" name="product_name" placeholder="Search Products by Name..." class="border border-gray-300 rounded-lg py-2 px-4 text-gray-700">
        <input type="number" name="price" placeholder="Max Price..." class="border border-gray-300 rounded-lg py-2 px-4 text-gray-700">
        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500">Search</button>
    </div>
</form>


    <!-- Products Grid -->
    <h2 class="text-2xl font-semibold mb-6">ALL PRODUCTS</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($products as $product)
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <div class="bg-black p-2 rounded-lg shadow"> <!-- เปลี่ยนกรอบเป็นสีดำ -->
                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="w-full h-auto mb-4 rounded">
            </div>
            <h3 class="text-xl font-bold mb-2">{{ $product->product_name }}</h3>
            <p class="text-gray-600">{{ number_format($product->price, 2) }} Baht</p>
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

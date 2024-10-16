<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}"> <!-- Link to your custom CSS -->
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
        <li class="nav-item"><a href="{{ route('admin') }}" class="hover:text-blue-500">HOME</a></li>
                <li class="nav-item"><a href=" " class="hover:text-blue-500">ABOUT</a></li>
                <li class="nav-item"><a href="{{ route('shop') }}" class="hover:text-blue-500">SHOP</a></li>
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
                        <a href="{{ asset('html/Dashboard.html') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                </ul>
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Login</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contact Us Section -->
    <section class="container mx-auto mt-10">
        <div class="flex justify-center items-center">
            <h2 class="text-4xl font-bold">CONTACT US</h2>
        </div>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left: Get In Touch Form -->
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <h3 class="text-2xl font-semibold mb-6">Get In Touch</h3>
                <form action="#" method="post">
                    <input type="text" placeholder="Enter Name" required class="w-full mb-4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="text" placeholder="Enter Number" required class="w-full mb-4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="email" placeholder="Enter Email" required class="w-full mb-4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <textarea placeholder="Message..." required class="w-full mb-4 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">SEND NOW</button>
                </form>
            </div>

            <!-- Right: Talk To Us Information -->
            <div class="bg-white p-8 shadow-lg rounded-lg">
                <h3 class="text-2xl font-semibold mb-6">Talk To Us</h3>
                <ul class="space-y-8">
                    <li>
                        <p class="font-bold text-gray-800">Email</p>
                        <span class="text-gray-600">DPStore@gmail.com</span>
                    </li>
                    <li>
                        <p class="font-bold text-gray-800">Phone Number</p>
                        <span class="text-gray-600">099-221-3431</span>
                    </li>
                    <li>
                        <p class="font-bold text-gray-800">Address</p>
                        <span class="text-gray-600">Kasetsart University, Kamphaeng Saen Campus</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-white mt-10">
        <div class="container mx-auto py-6 text-center">
            <p>&copy; 2024 Technology DP Store</p>
        </div>
    </footer>

    <script src="{{ asset('admin-asset/JavaScript/script.js') }}"></script>
</body>

</html>

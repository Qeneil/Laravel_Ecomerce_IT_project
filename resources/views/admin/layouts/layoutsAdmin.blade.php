<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Store Management - DP Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="{{ route('admin') }}" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="{{ route('shop') }}" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
        <div class="flex space-x-4 relative items-center">
            <button id="dropdownInformationButton"
                class="text-gray-800 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center dark:text-white"
                type="button">
                <span>User Test</span>
            </button>
            <!-- ไอคอนลูกศรชี้ขวา -->
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="text-gray-800 hover:text-red-500" title="Logout">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h12v16H6V4zm4 10h4m-4-4h4" />
        </svg>
    </button>
</form>
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
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                </ul>
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Login</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Drawer Navigation -->
        <div id="drawer" class="bg-white w-64 h-screen shadow-lg transition-transform transform -translate-x-full">
            <div class="p-5 flex items-center justify-between">
                <h3 class="text-xl font-bold">Store Management</h3>
                <!-- Close Drawer Icon -->
                <button id="closeDrawer" class="text-gray-800 hover:text-blue-500">
                    <img src="{{ asset('admin-asset/images/cancel.png') }}" alt="Close Menu" class="w-6 h-6">
                </button>
            </div>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('admin.category.allcategory') }}" class="block p-2 hover:bg-gray-200">All Category</a></li>
                <li><a href="{{ route('admin.category.create') }}" class="block p-2 hover:bg-gray-200">Add Category</a></li>
                <li><a href="{{ route('admin.product.allproduct') }}" class="block p-2 hover:bg-gray-200">All Product</a></li>
                <li><a href="{{ route('admin.product.addproduct') }}" class="block p-2 hover:bg-gray-200">Add Product</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">Pending Order</a></li>
            </ul>
        </div>

        <!-- Toggle Menu Icon below the header -->
        <button id="toggleDrawer" class="absolute left-5 top-24 z-50">
            <img src="{{ asset('admin-asset/images/menu-bar.png') }}" alt="Toggle Menu" class="w-8 h-8">
        </button>

        <div class="flex-1 p-5">
            <h2 class="text-3xl font-bold mt-5">Dashboard</h2>
            <p class="mt-3">Welcome to the store management dashboard!</p>
            <!-- Add dashboard content here -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-10 py-6 text-center">
        <p>&copy; 2024 Technology DP Store</p>
    </footer>

    <script src="{{ asset('admin-asset/JavaScript/script.js') }}" defer></script>
</body>

</html>

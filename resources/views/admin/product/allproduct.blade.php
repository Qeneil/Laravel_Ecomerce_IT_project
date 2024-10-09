<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Management - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

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

    <div class="flex flex-grow">
        <!-- Drawer Navigation -->
        <div id="drawer" class="bg-white w-64 h-screen shadow-lg transition-transform transform -translate-x-full">
            <div class="p-5 flex items-center justify-between">
                <h3 class="text-xl font-bold">Store Management</h3>
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

        <!-- All Products Content -->
        <div class="flex flex-col items-center p-5 w-full">
            <h1 class="text-2xl font-bold mb-5">All Products</h1>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-md mb-4 w-full max-w-4xl">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded-md mb-4 w-full max-w-4xl">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-5 w-full max-w-4xl">
                <table class="min-w-full mx-auto table-fixed text-center">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Product Name</th>
                            <th class="py-2 px-4 border-b">Image</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($products as $product)
        <tr class="border-b">
            <td class="py-2 px-4">{{ $product->product_id }}</td>
            <td class="py-2 px-4">{{ $product->product_name }}</td>
            <td class="py-2 px-4">
                <img src="{{ asset($product->image) }}" alt="{{ $product->product_name }}" class="w-24 h-auto max-h-24 mx-auto block">
            </td>
            <td class="py-2 px-4">{{ number_format($product->price, 2) }}</td>
            <td class="py-4 px-4 flex justify-center space-x-2 action-buttons">
                <a href="{{ route('admin.product.edit', $product->product_id) }}" class="edit-btn bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                <form action="{{ route('admin.product.destroy', $product->product_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-10 py-6 text-center">
        <p>&copy; 2024 Technology DP Store</p>
    </footer>

    <script src="{{ asset('admin-asset/JavaScript/script.js') }}" defer></script>
</body>

</html>

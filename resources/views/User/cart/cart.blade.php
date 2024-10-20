<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="#" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
        <div class="flex space-x-4 relative">
            <a href="#" class="no-underline">
                <img src="{{ asset('admin-asset/images/cart.svg') }}" alt="Shopping Cart Icon" class="w-7 h-7">
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="text-gray-800 hover:text-red-500" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h12v16H6V4zm4 10h4m-4-4h4" />
                    </svg>
                </button>
            </form>
            <!-- Dropdown Button -->
            <button id="dropdownInformationButton"
                class="text-gray-800 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center"
                type="button">
                <span>User Test</span>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdownInformation"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <div class="px-4 py-3 text-sm text-gray-900">
                    <div>Test Beta</div>
                    <div class="font-medium truncate">user@gmail.com</div>
                </div>
                <ul class="py-2 text-sm text-gray-700">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">My Profile</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">My Orders</a>
                    </li>
                    <li>
                        <a href="/html/Dashboard.html" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                    </li>
                </ul>
                <div class="py-2">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex-grow">
        <h1 class="text-2xl font-bold mb-6 text-center">Shopping Cart</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-center">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Product Name</th>
                        <th class="py-3 px-4 border-b">Product Image</th>
                        <th class="py-3 px-4 border-b">Price (Baht)</th>
                        <th class="py-3 px-4 border-b">Quantity</th>
                        <th class="py-3 px-4 border-b">Total (Baht)</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cartItems as $item)
                    <tr class="hover:bg-gray-100 text-center">
                        <td class="py-2 px-4 border-b">{{ $item->product->product_id }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->product->product_name }}</td>
                        <td class="py-2 px-4 border-b">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->product_name }}"
                                class="w-16 h-16 object-cover mx-auto">
                        </td>
                        <td class="py-2 px-4 border-b">{{ number_format($item->product->price, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ $item->quantity }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format(($item->product->price) * $item->quantity, 2) }}
                        </td>
                        <td class="py-2 px-4 border-b">
                        <form action="{{ route('removeItemById', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:text-red-700">
        <i class="fas fa-times"></i>
    </button>
</form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Your cart is empty</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4 space-x-2">
            <form action="{{ route('removeAll') }}" method="POST"
                onsubmit="return confirm('Are you sure you want to remove all items?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
                    Remove
                </button>
            </form>
            <a href="{{ route('checkout') }}" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">
    Checkout
</a>
        </div>
    </div>

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

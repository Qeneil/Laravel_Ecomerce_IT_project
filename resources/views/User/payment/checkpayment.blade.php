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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V4a2 2 0 00-2-2H6zm0 2h12v16H6V4zm4 10h4m-4-4h4" />
                    </svg>
                </button>
            </form>
            <button id="dropdownInformationButton" class="text-gray-800 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
                <span>User Test</span>
            </button>

            <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
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

    <div class="container mx-auto mt-10 flex-grow p-5">
        <h1 class="text-2xl font-bold mb-6 text-center">Payment Status</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded my-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded my-4">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mt-5">Your Orders</h2>
        @if($orders->isEmpty())
            <p class="mt-2">You have no orders yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="py-3 px-4 border-b">Order ID</th>
                            <th class="py-3 px-4 border-b">Product ID</th>
                            <th class="py-3 px-4 border-b">Product Name</th>
                            <th class="py-3 px-4 border-b">Quantity</th>
                            <th class="py-3 px-4 border-b">Price (Baht)</th>
                            <th class="py-3 px-4 border-b">Total (Baht)</th>
                            <th class="py-3 px-4 border-b">Product Image</th>
                            <th class="py-3 px-4 border-b">Status</th> <!-- เพิ่มคอลัมน์สถานะ -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @foreach($order->orderDetails as $detail)
                                <tr class="hover:bg-gray-100 text-center">
                                    <td class="py-2 px-4 border-b">{{ $order->order_id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->product_id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->product->product_name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $detail->quantity }}</td>
                                    <td class="py-2 px-4 border-b">{{ number_format($detail->price, 2) }}</td>
                                    <td class="py-2 px-4 border-b">{{ number_format(($detail->price) * $detail->quantity, 2) }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if($detail->product->image)
                                            <img src="{{ asset($detail->product->image) }}" alt="{{ $detail->product->product_name }}" class="w-16 h-16 object-cover mx-auto">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $order->order_status }}</td> <!-- แสดงสถานะที่นี่ -->
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('mainshop') }}" class="inline-block mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
            Go to Homepage
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 py-12">
        <div class="max-w-6xl mx-auto text-center space-y-6">
            <div class="text-lg font-bold">DP STORE</div>
            <p class="text-gray-600">Secure Payment | Delivered With Care | Excellent Service</p>
            <div class="text-sm text-gray-500">© 2024 Technology DP Store</div>
        </div>
    </footer>

    <script src="{{ asset('admin-asset/JavaScript/script.js') }}"></script>
</body>

</html>

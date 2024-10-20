<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Orders - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="{{ route('admin') }}" class="hover:text-blue-500">HOME</a></li>
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
        </div>
    </nav>

    <div class="flex flex-grow">
        <div class="flex flex-col items-center p-5 w-full">
            <h1 class="text-2xl font-bold mb-5">Approve Orders</h1>

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
                            <th class="py-2 px-4 border-b">Order Detail ID</th>
                            <th class="py-2 px-4 border-b">Order ID</th>
                            <th class="py-2 px-4 border-b">Product ID</th>
                            <th class="py-2 px-4 border-b">Product Images</th> <!-- คอลัมน์รูปภาพ -->
                            <th class="py-2 px-4 border-b">Quantity</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->orderDetails as $detail)
                                <tr>
                                    <td class="py-2 px-4">{{ $detail->order_detail_id }}</td>
                                    <td class="py-2 px-4">{{ $order->order_id }}</td>
                                    <td class="py-2 px-4">{{ $detail->product_id }}</td>
                                    <td class="py-2 px-4">
                                        @if ($detail->product->image)
                                            <img src="{{ asset($detail->product->image) }}" alt="{{ $detail->product->product_name }}" class="w-16 h-16 object-cover mx-auto">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">{{ $detail->quantity }}</td>
                                    <td class="py-2 px-4">{{ number_format($detail->price, 2) }}</td>
                                    <td class="py-2 px-4">{{ $order->order_status }}</td>
                                    <td class="py-4 px-4 flex justify-center space-x-2">
                                    <form action="{{ route('admin.orders.approve', $order->order_id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-green-500 text-white rounded hover:bg-green-600">Approve</button>
</form>
                                    </td>
                                </tr>
                            @endforeach
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

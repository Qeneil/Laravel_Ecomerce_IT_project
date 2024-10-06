<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - DP Store</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-asset/css/style.css') }}">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="flex justify-between items-center p-5 bg-white shadow-md">
        <div class="text-2xl font-bold logo">DP STORE</div>
        <ul class="flex space-x-6">
            <li class="nav-item"><a href="{{ url('Homepage.html') }}" class="hover:text-blue-500">HOME</a></li>
            <li class="nav-item"><a href="#" class="hover:text-blue-500">ABOUT</a></li>
            <li class="nav-item"><a href="{{ url('Shop.html') }}" class="hover:text-blue-500">SHOP</a></li>
            <li class="nav-item"><a href="{{ url('Contact.html') }}" class="hover:text-blue-500">CONTACT</a></li>
        </ul>
    </nav>

    <div class="flex">
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
                <li><a href="{{ route('admin.product.create') }}" class="block p-2 hover:bg-gray-200">Add Product</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">Pending Order</a></li>
            </ul>
        </div>

        <button id="toggleDrawer" class="absolute left-5 top-24 z-50">
            <img src="{{ asset('admin-asset/images/menu-bar.png') }}" alt="Toggle Menu" class="w-8 h-8">
        </button>

        <!-- All Products Section -->
        <div class="flex-1 p-5">
            <h2 class="text-3xl font-bold mb-4">All Products</h2>
            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Product Name</th>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->product_name }}</td>
                            <td class="py-2 px-4 border-b">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-20 h-20 object-cover">
                            </td>
                            <td class="py-2 px-4 border-b">{{ number_format($product->price, 2) }} ฿</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const toggleDrawer = document.getElementById('toggleDrawer');
        const drawer = document.getElementById('drawer');
        const closeDrawer = document.getElementById('closeDrawer');

        toggleDrawer.onclick = () => {
            drawer.classList.toggle('-translate-x-full'); // Toggle the drawer
        };

        closeDrawer.onclick = () => {
            drawer.classList.add('-translate-x-full'); // Close the drawer
        };
    </script>
</body>

</html>

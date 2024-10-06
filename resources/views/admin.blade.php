@extends('admin.layouts.layoutsAdmin')

@section('content')
    <!-- Dashboard Content -->
    <div class="flex">
        <!-- Drawer Navigation -->
        <div id="drawer" class="bg-white w-64 h-screen shadow-lg transition-transform transform -translate-x-full">
            <div class="p-5 flex items-center justify-between">
                <h3 class="text-xl font-bold">การจัดการร้านค้า</h3>
                <!-- Close Drawer Icon -->
                <button id="closeDrawer" class="text-gray-800 hover:text-blue-500">
                    <img src="{{ asset('admin-asset/images/cancel.png') }}" alt="ปิดเมนู" class="w-6 h-6">
                </button>
            </div>
            <ul class="mt-4 space-y-2">
                <li><a href="{{ route('admin.category.allcategory') }}" class="block p-2 hover:bg-gray-200">หมวดหมู่ทั้งหมด</a></li>
                <li><a href="{{ route('admin.category.create') }}" class="block p-2 hover:bg-gray-200">เพิ่มหมวดหมู่</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">สินค้าทั้งหมด</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">เพิ่มสินค้า</a></li>
                <li><a href="#" class="block p-2 hover:bg-gray-200">คำสั่งซื้อที่รอดำเนินการ</a></li>
            </ul>
        </div>

        <!-- Toggle Menu Icon below the header -->
        <button id="toggleDrawer" class="absolute left-5 top-24 z-50">
            <img src="{{ asset('admin-asset/images/menu-bar.png') }}" alt="เปิดเมนู" class="w-8 h-8">
        </button>

        <div class="flex-1 p-5">
            <h2 class="text-3xl font-bold mt-5">แดชบอร์ด</h2>
            <p class="mt-3">ยินดีต้อนรับสู่แดชบอร์ดการจัดการร้านค้า!</p>
            <!-- เพิ่มเนื้อหาของแดชบอร์ดที่นี่ -->
        </div>
    </div>

    <script>
        // Toggle drawer functionality
        const toggleDrawer = document.getElementById('toggleDrawer');
        const drawer = document.getElementById('drawer');
        const closeDrawer = document.getElementById('closeDrawer');

        // เปิด/ปิดเมนู
        toggleDrawer.addEventListener('click', () => {
            drawer.classList.toggle('-translate-x-full');
        });

        // ปิดเมนู
        closeDrawer.addEventListener('click', () => {
            drawer.classList.add('-translate-x-full');
        });
    </script>
@endsection

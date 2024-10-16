<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Product Name</th>
                        <th class="py-2 px-4 border-b">Price (Baht)</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Total (Baht)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Row -->
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">1</td>
                        <td class="py-2 px-4 border-b">Product A</td>
                        <td class="py-2 px-4 border-b">100.00</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" value="1" min="1" class="border border-gray-300 rounded w-16 px-2">
                        </td>
                        <td class="py-2 px-4 border-b">100.00</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">2</td>
                        <td class="py-2 px-4 border-b">Product B</td>
                        <td class="py-2 px-4 border-b">200.00</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" value="1" min="1" class="border border-gray-300 rounded w-16 px-2">
                        </td>
                        <td class="py-2 px-4 border-b">200.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Checkout
            </button>
        </div>
    </div>

</body>

</html>

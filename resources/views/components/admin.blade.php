<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <title>Document</title>

</head>
<body>
<section>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle"/>
        <div class="drawer-content">
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden"> Open drawer </label>
            <main class="bg-gray-100 relative">

                <section class="bg-blue-600 text-white p-4 shadow-md fixed top-0 w-full z-10">
                    <h1 class="text-xl font-bold">Admin Dashboard</h1>
                </section>
                <div class=" absolute top-14 left-0 w-full">
                    @include('helper.notify')
                </div>
                {{ $slot }}
                <section class="bg-gray-800 text-white p-4 text-center mt-auto">
                    <p>&copy; 2024 Car Rental System. All Rights Reserved.</p>
                </section>
            </main>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu min-h-full w-fit bg-slate-800 text-white px-8 py-14">
                <li><h1 class="text-xl font-bold">Admin Dashboard</h1></li>
                <li><a href="{{url('/admin')}}" class="text-base ms-5">Dashboard</a></li>
                <li><h1 class="text-xl font-bold mt-5">Car Management</h1></li>
                <li><a href="{{url('/admin/car-manage')}}" class="text-base ms-5">All Cars</a></li>
                <li><a href="{{url('/admin/add-car')}}" class="text-base ms-5">Add Cars</a></li>
                <li><h1 class="text-xl font-bold mt-4">Rental Management</h1></li>
                <li><a href="{{url('/admin/rental-manage')}}" class="text-base ms-5">All Rentals</a></li>
                <li><h1 class="text-xl font-bold mt-4">Customer Management</h1></li>
                <li><a href="{{url('/admin/customer-manage')}}" class="text-base ms-5">All Customers</a></li>
                <li><a href="{{url('/admin/add-customer')}}" class="text-base ms-5">Add Customers</a></li>
                <li>
                    <a href="{{url('/')}}" class="text-lg mt-5">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<script src="https://cdn.tailwindcss.com"></script>

@yield('script')

</body>
</html>

<?php

    use Illuminate\Support\Facades\Route;


    Route::view('/', 'users.index');
    Route::view('/rentals', 'users.rentals');
    Route::view('/login', 'auth.login');
    Route::view('/register', 'auth.register');


//    Admin Routes

    Route::view('/admin', 'admin.index');

    Route::view('/admin/car-manage', 'admin.carManage');
    Route::view('/admin/add-car', 'admin.addCars');
    Route::view('/admin/update-car', 'admin.updateCars');

    Route::view('/admin/rental-manage', 'admin.rentManage');

    Route::view('/admin/customer-manage', 'admin.cusManage');
    Route::view('/admin/add-customer', 'admin.addCustomer');
    Route::view('/admin/update-customer', 'admin.updateCustomer');

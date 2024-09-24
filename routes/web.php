<?php

    use App\Http\Controllers\Frontend\CarController;
    use App\Http\Controllers\Frontend\PageController;
    use App\Http\Controllers\Frontend\RentalController;
    use Illuminate\Support\Facades\Route;


//    Admin Routes


    Route::view('/admin/rental-manage', 'admin.rentManage');

    // user path
    Route::get('/', [PageController::class, 'index']);
    Route::get('/rentals', [PageController::class, 'rentals']);
    Route::get('/login', [PageController::class, 'login']);
    Route::get('/register', [PageController::class, 'register']);

    // admin path
    Route::get('/admin', [PageController::class, 'admin']);
    Route::get('/admin/car-manage', [PageController::class, 'carManage']);
    Route::get('/admin/add-car', [PageController::class, 'addCar']);
    Route::get('/admin/update-car', [PageController::class, 'updateCar']);
    Route::get('/admin/rental-manage', [PageController::class, 'rentalManage']);
    Route::get('/admin/customer-manage', [PageController::class, 'customerManage']);
    Route::get('/admin/add-customer', [PageController::class, 'addCustomer']);
    Route::get('/admin/update-customer', [PageController::class, 'updateCustomer']);

    // car api path
    Route::get('/api/cars', [CarController::class, 'carsList']);

    // rental api path
    Route::get('/api/rentals', [RentalController::class, 'rentalsList']);
    Route::post('/api/rentalInfo', [RentalController::class, 'rentalDetail']);

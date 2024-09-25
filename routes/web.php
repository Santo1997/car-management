<?php

    use App\Http\Controllers\Frontend\CarController as FrontendCarController;
    use App\Http\Controllers\Admin\CarController as AdminCarController;
    use App\Http\Controllers\Frontend\PageController;
    use App\Http\Controllers\Frontend\RentalController;
    use Illuminate\Support\Facades\Route;

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

    // api path for user
    Route::get('/api/cars', [FrontendCarController::class, 'carsList']);
    Route::get('/api/rentals', [RentalController::class, 'rentalsList']);
    Route::post('/api/rentalInfo', [RentalController::class, 'rentalDetail']);
    Route::post('/api/createRental', [RentalController::class, 'createRental']);
    Route::post('/api/deleteRental', [RentalController::class, 'deleteRental']);

    // api path for admin
    Route::get('/api/admin/cars', [AdminCarController::class, 'carsList']);
    Route::get('/api/admin/carDetails/{id}', [AdminCarController::class, 'carDtails']);
    Route::post('/api/admin/addCar', [AdminCarController::class, 'addCar']);
    Route::post('/api/admin/updateCar/{id}', [AdminCarController::class, 'updateCar']);
    Route::post('/api/admin/deleteCar', [AdminCarController::class, 'deleteCar']);



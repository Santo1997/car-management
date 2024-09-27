<?php

    use App\Http\Controllers\Admin\RentalController as AdminRentalController;
    use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
    use App\Http\Controllers\Admin\CarController as AdminCarController;
    use App\Http\Controllers\Frontend\CarController;
    use App\Http\Controllers\Frontend\PageController;
    use App\Http\Controllers\Frontend\RentalController;
    use App\Http\Middleware\AdminCheck;
    use App\Http\Middleware\TokenAuthentic;
    use Illuminate\Support\Facades\Route;

    // user path
    Route::get('/', [PageController::class, 'index']);
    Route::get('/rentals', [PageController::class, 'rentals'])->middleware([TokenAuthentic::class]);
    Route::get('/login', [PageController::class, 'login']);
    Route::get('/register', [PageController::class, 'register']);

    // admin path
    Route::get('/admin', [PageController::class, 'admin'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/car-manage', [PageController::class, 'carManage'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/add-car', [PageController::class, 'addCar'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/update-car', [PageController::class, 'updateCar'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/rental-manage', [PageController::class, 'rentalManage'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/customer-manage', [PageController::class, 'customerManage'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/add-customer', [PageController::class, 'addCustomer'])->middleware([TokenAuthentic::class, AdminCheck::class]);
    Route::get('/admin/update-customer', [PageController::class, 'updateCustomer'])->middleware([TokenAuthentic::class, AdminCheck::class]);

    // api path for user
    Route::get('/api/cars', [CarController::class, 'carsList']);
    Route::get('/api/rentals', [RentalController::class, 'rentalsList']);
    Route::get('/api/rentalInfo', [RentalController::class, 'rentalDetail'])->middleware([TokenAuthentic::class]);
    Route::post('/api/createRental', [RentalController::class, 'createRental'])->middleware([TokenAuthentic::class]);
    Route::post('/api/deleteRental', [RentalController::class, 'deleteRental'])->middleware([TokenAuthentic::class]);

    // api path for admin
    Route::get('/api/admin/totalDetails', [AdminCarController::class, 'totalDetails'])->middleware([TokenAuthentic::class]); //for admin dashboard
    Route::get('/api/admin/cars', [AdminCarController::class, 'carsList'])->middleware([TokenAuthentic::class]);
    Route::get('/api/admin/carDetails/{id}', [AdminCarController::class, 'carDetails'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/addCar', [AdminCarController::class, 'addCar'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/updateCar/{id}', [AdminCarController::class, 'updateCar'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/deleteCar', [AdminCarController::class, 'deleteCar'])->middleware([TokenAuthentic::class]);

    Route::post('/api/addCustomer', [AdminCustomerController::class, 'createCustomer']);
    Route::post('/api/loginUser', [AdminCustomerController::class, 'loginUser']);
    Route::get('/logout', [AdminCustomerController::class, 'logoutUser']);
    Route::get('/api/admin/customers', [AdminCustomerController::class, 'customersList'])->middleware([TokenAuthentic::class]);
    Route::get('/api/admin/customerDetails/{id}', [AdminCustomerController::class, 'customerDetails'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/updateCustomer/{id}', [AdminCustomerController::class, 'updateCustomer'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/deleteCustomer', [AdminCustomerController::class, 'deleteCustomer'])->middleware([TokenAuthentic::class]);

    Route::get('/api/admin/rentals', [AdminRentalController::class, 'rentalsList'])->middleware([TokenAuthentic::class]);
    Route::post('/api/admin/deleteRental', [AdminRentalController::class, 'deleteRental'])->middleware([TokenAuthentic::class]);


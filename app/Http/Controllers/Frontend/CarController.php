<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Car;
    use Illuminate\Http\Request;

    class CarController extends Controller {
        public function carsList() {
            $carsList = Car::all();
            return ResponseHelper::out('success', $carsList, 200);
        } //ok
    }

<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Car;
    use Illuminate\Http\Request;

    class CarController extends Controller {
        public function carsList() {
            $carsList = Car::where('availability', 1)->get();
            return ResponseHelper::out('success', $carsList, 200);
        } //ok
    }

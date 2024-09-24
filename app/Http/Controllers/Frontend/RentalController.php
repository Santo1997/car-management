<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Rental;
    use Illuminate\Http\Request;

    class RentalController extends Controller {
        public function rentalsList() {
            $rentalsList = Rental::all();
            return ResponseHelper::out('success', $rentalsList, 200);
        }

        public function rentalDetail(Request $request) {
            $rentalDetail = Rental::where('user_id', $request->input('user_id'))->get();
            return ResponseHelper::out('success', $rentalDetail, 200);
        }
    }

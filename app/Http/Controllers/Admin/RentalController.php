<?php

    namespace App\Http\Controllers\Admin;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Rental;
    use Illuminate\Http\Request;

    class RentalController extends Controller {
        public function rentalsList() {
            $rentalsList = Rental::with('user', 'car')->get();
            return ResponseHelper::out('success', $rentalsList, 200);
        }

        public function deleteRental(Request $request) {
            $rental = Rental::where('id', $request->input('id'))->delete();
            return ResponseHelper::out('success', $rental, 200);
        }
    }

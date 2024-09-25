<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Rental;
    use Exception;
    use Illuminate\Http\Request;

    class RentalController extends Controller {
        public function rentalsList() {
            $rentalsList = Rental::all();
            return ResponseHelper::out('success', $rentalsList, 200);
        }

        public function rentalDetail(Request $request) {
            $rentalDetail = Rental::where('user_id', $request->input('user_id'))->with('car')->get();
            return ResponseHelper::out('success', $rentalDetail, 200);
        }

        public function createRental(Request $request) {
            try {
                $newRent = Rental::create([
                    'car_id' => $request->input('car_id'),
                    'user_id' => $request->input('user_id'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'total_cost' => $request->input('cost'),
                ]);

                return ResponseHelper::out('success', $newRent, 200);
            } catch (Exception $e) {
                return ResponseHelper::out('error', 0, 404);
            }

        }

        public function deleteRental(Request $request) {
            $rental = Rental::where('user_id', $request->input('user_id'))->where('id', $request->input('rental_id'))->delete();
            return ResponseHelper::out('success', $rental, 200);
        }
    }

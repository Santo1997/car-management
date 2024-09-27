<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Mail\SendMailer;
    use App\Models\Rental;
    use App\Models\User;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class RentalController extends Controller {
        public function rentalsList() {
            $rentalsList = Rental::all();
            return ResponseHelper::out('success', $rentalsList, 200);
        } //ok

        public function rentalDetail(Request $request) {
            $id = $request->header('uId');
            $rentalDetail = Rental::where('user_id', $id)->with('car')->get();
            return ResponseHelper::out('success', $rentalDetail, 200);
        } //ok

        public function createRental(Request $request) {
            $email = $request->header('email');
            try {
                $newRent = Rental::create([
                    'car_id' => $request->input('car_id'),
                    'user_id' => $request->header('uId'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'total_cost' => $request->input('cost'),
                ]);

                if (!$newRent) {
                    return response()->json($newRent, 404);
                } else {
                    $adminEmail = User::where('role', 'admin')->select('email')->first();
                    $data = Rental::where('id', $newRent->id)->with('car', 'user')->first();
                    Mail::to($email)->send(new SendMailer($data));
                    Mail::to($adminEmail)->send(new SendMailer($data));
                }

                return ResponseHelper::out('success', $data, 200);
            } catch (Exception $e) {
                return ResponseHelper::out('error', 0, 404);
            }

        } //ok

        public function deleteRental(Request $request) {
            $rental = Rental::where('user_id', $request->header('uId'))->where('id', $request->input('rental_id'))->delete();
            return ResponseHelper::out('success', $rental, 200);
        } //ok
    }

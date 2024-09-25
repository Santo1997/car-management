<?php

    namespace App\Http\Controllers\Admin;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Car;
    use Exception;
    use Illuminate\Http\Request;

    class CarController extends Controller {
        public function carsList() {
            $carsList = Car::all();
            return ResponseHelper::out('success', $carsList, 200);
        }

        public function carDtails($id) {
            $carDetail = Car::where('id', $id)->get();
            return ResponseHelper::out('success', $carDetail, 200);
        }

        public function addCar(Request $request) {
            try {
                $car = Car::create([
                    'name' => $request->input('name'),
                    'brand' => $request->input('brand'),
                    'model' => $request->input('model'),
                    'year' => $request->input('year'),
                    'car_type' => $request->input('car_type'),
                    'daily_rent_price' => $request->input('daily_rent_price'),
                    'image' => $request->input('image'),
                    'availability' => $request->input('availability'),
                ]);

                return ResponseHelper::out('success', $car, 200);
            } catch (Exception $e) {
                return $e->getMessage(); //ResponseHelper::out('error', 0, 401);
            }
        }


        public function updateCar(Request $request, $id) {
            $car = Car::where('id', $id)->update([
                'name' => $request->input('name'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'car_type' => $request->input('car_type'),
                'daily_rent_price' => $request->input('daily_rent_price'),
                'image' => $request->input('image'),
                'availability' => $request->input('availability'),
            ]);
            return ResponseHelper::out('success', $car, 200);
        }

        public function deleteCar(Request $request) {
            $car = Car::where('id', $request->input('id'))->delete();
            return ResponseHelper::out('success', $car, 200);
        }
    }




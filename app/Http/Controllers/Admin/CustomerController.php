<?php

    namespace App\Http\Controllers\Admin;

    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Exception;
    use Illuminate\Http\Request;

    class CustomerController extends Controller {
        public function customersList() {
            $customersList = User::all();
            return ResponseHelper::out('success', $customersList, 200);
        }

        public function customerDetails($id) {
            $customerDetail = User::where('id', $id)->get();
            return ResponseHelper::out('success', $customerDetail, 200);
        }

        public function addCustomer(Request $request) {
            try {
                $customerCount = User::count();
                $role = $customerCount == 0 ? 'admin' : 'customer';

                $customer = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'password' => $request->input('password'),
                    'role' => $role,
                ]);

                return ResponseHelper::out('success', $customer, 200);
            } catch (Exception $e) {
                return ResponseHelper::out('error', 0, 401);
            }
        }

        public function updateCustomer(Request $request, $id) {
            $customer = User::where('id', $id)->update([
                'name' => $request->input('name'),
                'role' => $request->input('role'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
            ]);
            return ResponseHelper::out('success', $customer, 200);
        }

        public function deleteCustomer(Request $request) {
            $customer = User::where('id', $request->input('id'))->delete();
            return ResponseHelper::out('success', $customer, 200);
        }
    }

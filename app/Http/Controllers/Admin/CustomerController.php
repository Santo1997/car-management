<?php

    namespace App\Http\Controllers\Admin;

    use App\Helper\JWTToken;
    use App\Helper\ResponseHelper;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class CustomerController extends Controller {

        public function createCustomer(Request $request) {
            try {
                $role = User::count() == 0 ? 'admin' : 'customer';

                $customer = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'password' => $request->input('password'),
                    'role' => $role,
                ]);

                return ResponseHelper::out('Register successfully', $customer, 200);
            } catch (Exception $e) {
                return ResponseHelper::out('error', 0, 401);
            }
        } //ok

        public function loginUser(Request $request) {
            $user = User::where('email', $request->input('email'))
                ->where('password', $request->input('password'))
                ->select('id', 'role')
                ->first();

            Auth::login($user);

            if ($user !== null) {
                $token = JWTToken::generateToken($request->input('email'), $user->id);

                if ($user->isAdmin()) {
                    return ResponseHelper::out('Admin Login successfully.', $user, 200)
                        ->cookie('token', $token, 60 * 24 * 30);
                } elseif ($user->isCustomer()) {
                    return ResponseHelper::out('Login successfully.', $user, 200)
                        ->cookie('token', $token, 60 * 24 * 30);
                }
            }
            return ResponseHelper::out('User Login failed.', 0, 401);

        } //ok

        public function logoutUser() {
            Auth::logout();
            return redirect('/login')->cookie('token', '', -1);
        } //ok

        public function customersList() {
            $customersList = User::all();
            return ResponseHelper::out('success', $customersList, 200);
        }

        public function customerDetails($id) {
            $customerDetail = User::where('id', $id)->get();
            return ResponseHelper::out('success', $customerDetail, 200);
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

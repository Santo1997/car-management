<?php

    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class PageController extends Controller {

        //user page
        public function index() {
            return view('users.index');
        }

        public function rentals() {
            return view('users.rentals');
        }

        public function login() {
            return view('auth.login');
        }

        public function register() {
            return view('auth.register');
        }

        //admin page
        public function admin() {
            return view('admin.index');
        }

        public function carManage() {
            return view('admin.carManage');
        }

        public function addCar() {
            return view('admin.addCars');
        }

        public function updateCar() {
            return view('admin.updateCars');
        }

        public function rentalManage() {
            return view('admin.rentManage');
        }

        public function customerManage() {
            return view('admin.cusManage');
        }

        public function addCustomer() {
            return view('admin.addCustomer');
        }

        public function updateCustomer() {
            return view('admin.updateCustomer');
        }

    }


<x-admin>
    <section class="container min-h-[calc(100vh-140px)] mx-auto py-10">
        <h1 class="text-2xl font-bold mb-10">Add Customer</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="addCustomer(event)" class="grid gap-4">
                <div>
                    <label for="customer" class="block text-gray-700">Customer Name</label>
                    <input type="text" id="customer" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="phone" class="block text-gray-700">Phone Number</label>
                    <input type="text" id="phone" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" id="address" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="address" class="block text-gray-700">Password</label>
                    <input type="password" id="password" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-14 rounded-md">Save Customer</button>
                </div>
            </form>
        </div>
    </section>

    @section('script')
        <script>
            function addCustomer(event) {
                event.preventDefault();
                showLoader();
                let form = event.target;

                let newCustomer = {
                    name: form.customer.value,
                    email: form.email.value,
                    phone: form.phone.value,
                    address: form.address.value,
                    password: form.password.value,
                };

                axios
                    .post("/api/addCustomer", newCustomer)
                    .then((res) => {
                        event.target.reset();
                        window.location.href = "/admin/customer-manage";
                        toaster("Customer Added Successfully");
                    })
                    .catch((error) => {
                        toaster("Something went wrong");
                    })
                    .finally(() => {
                        showLoader(false);
                    });
            }
        </script>
    @endsection
</x-admin>

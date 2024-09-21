<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-2xl font-bold mb-10">Add Customer</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="addCars(event)" class="grid gap-4">
                <div>
                    <label for="customer" class="block text-gray-700">Customer Name</label>
                    <input type="text" id="customer" class="w-full p-2 border border-gray-300 rounded-md" value="Toyota"
                           required/>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded-md"
                           value="toyota@toyota" required/>
                </div>
                <div>
                    <label for="phone" class="block text-gray-700">Phone Number</label>
                    <input type="text" id="phone" class="w-full p-2 border border-gray-300 rounded-md"
                           value="01712393087" required/>
                </div>
                <div>
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" id="address" class="w-full p-2 border border-gray-300 rounded-md"
                           value="Mohammadpur, Dhaka" required/>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-14 rounded-md">Save Car</button>
                </div>
            </form>
        </div>
    </section>

    @section('script')
        <script>
            function addCars(event) {
                event.preventDefault();
                const customer = document.getElementById("customer").value;
                const email = document.getElementById("email").value;
                const phone = document.getElementById("phone").value;
                const address = document.getElementById("address").value;

                const newCustomer = {
                    user: customer,
                    email: email,
                    phone: phone,
                    address: address,
                };

                console.log(newCustomer);
            }
        </script>
    @endsection
</x-admin>

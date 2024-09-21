<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-2xl font-bold mb-10">Update Customer : <span id="ucId"></span></h1>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="updateCars(event)" class="grid gap-4">
                <div>
                    <label for="upCustomer" class="block text-gray-700">Customer Name</label>
                    <input type="text" id="upCustomer" class="w-full p-2 border border-gray-300 rounded-md"
                           value="Toyota" required/>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded-md"
                           value="toyota@toyota" readonly disabled/>
                </div>
                <div>
                    <label for="upPhone" class="block text-gray-700">Phone Number</label>
                    <input type="text" id="upPhone" class="w-full p-2 border border-gray-300 rounded-md"
                           value="01712393087" required/>
                </div>
                <div>
                    <label for="upAddress" class="block text-gray-700">Address</label>
                    <input type="text" id="upAddress" class="w-full p-2 border border-gray-300 rounded-md"
                           value="Mohammadpur, Dhaka" required/>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-14 rounded-md">Update Car</button>
                </div>
            </form>
        </div>
    </section>

    @section('script')
        <script>
            const params = new URLSearchParams(window.location.search);
            document.getElementById("ucId").innerHTML = params.get("id");

            function updateCars(event) {
                event.preventDefault();

                const upCustomer = document.getElementById("upCustomer").value;
                const phone = document.getElementById("upPhone").value;
                const address = document.getElementById("upAddress").value;

                const updateCustomer = {
                    user: upCustomer,
                    phone: phone,
                    address: address,
                };

                console.log(updateCustomer);
            }
        </script>
    @endsection
</x-admin>

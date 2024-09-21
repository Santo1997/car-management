<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-2xl font-bold mb-10">Update Rental : <span id="rtId"></span></h1>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="updateCars(event)" class="grid gap-4">
                <div>
                    <label for="rntCustomer" class="block text-gray-700">Customer Name</label>
                    <input type="text" id="rntCustomer" class="w-full p-2 border border-gray-300 rounded-md"
                           value="Toyota" required/>
                </div>
                <div>
                    <label for="rntCar" class="block text-gray-700">Car Details</label>
                    <input type="text" id="rntCar" class="w-full p-2 border border-gray-300 rounded-md"
                           value="toyota@toyota" required/>
                </div>
                <div>
                    <label class="block text-gray-700">Rental Start Date and End Date</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md" value="01712393087" readonly
                           disabled/>
                </div>
                <div>
                    <label for="rntCost" class="block text-gray-700">Total Cost</label>
                    <input type="number" id="rntCost" class="w-full p-2 border border-gray-300 rounded-md" value="100"
                           readonly disabled/>
                </div>
                <div>
                    <label for="rntStatus" class="block text-gray-700">Status</label>
                    <select id="rntStatus" value="Ongoing" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                        <option value="Canceled">Canceled</option>
                    </select>
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
            document.getElementById("rtId").innerHTML = params.get("id");

            function updateCars(event) {
                event.preventDefault();

                const rntCustomer = document.getElementById("rntCustomer").value;
                const rntCar = document.getElementById("rntCar").value;
                const rntStatus = document.getElementById("rntStatus").value;

                const updateRental = {
                    user: rntCustomer,
                    car: rntCar,
                    availability: rntStatus,
                };

                console.log(updateRental);
            }
        </script>
    @endsection
</x-admin>

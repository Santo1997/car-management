<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20">
        <h1 class="text-2xl font-bold mb-5">Add Car</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="addCars(event)" class="grid gap-4">
                <div>
                    <label for="carName" class="block text-gray-700">Car Name</label>
                    <input type="text" id="carName" class="w-full p-2 border border-gray-300 rounded-md" value="Toyota"
                           required/>
                </div>
                <div>
                    <label for="brand" class="block text-gray-700">Brand</label>
                    <input type="text" id="brand" class="w-full p-2 border border-gray-300 rounded-md" value="Toyota"
                           required/>
                </div>
                <div>
                    <label for="model" class="block text-gray-700">Model</label>
                    <input type="text" id="model" class="w-full p-2 border border-gray-300 rounded-md" value="Camry"
                           required/>
                </div>
                <div>
                    <label for="year" class="block text-gray-700">Year of Manufacture</label>
                    <input type="number" id="year" class="w-full p-2 border border-gray-300 rounded-md" value="2020"
                           required/>
                </div>
                <div>
                    <label for="carType" class="block text-gray-700">Car Type</label>
                    <input type="number" id="carType" class="w-full p-2 border border-gray-300 rounded-md" value="1"
                           required/>
                </div>

                <div>
                    <label for="dailyRentPrice" class="block text-gray-700">Daily Rent Price</label>
                    <input type="number" id="dailyRentPrice" min="0"
                           class="w-full p-2 border border-gray-300 rounded-md" value="1000" required/>
                </div>
                <div>
                    <label for="availabilityStatus" class="block text-gray-700">Availability Status</label>
                    <select id="availabilityStatus" value="Available"
                            class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                    </select>
                </div>
                <div>
                    <label for="carImage" class="block text-gray-700">Car Image URL</label>
                    <input type="url" id="carImage" class="w-full p-2 border border-gray-300 rounded-md"/>
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
                const carName = document.getElementById("carName").value;
                const brand = document.getElementById("brand").value;
                const model = document.getElementById("model").value;
                const year = document.getElementById("year").value;
                const carType = document.getElementById("carType").value;
                const dailyRentPrice = document.getElementById("dailyRentPrice").value;
                const availabilityStatus = document.getElementById("availabilityStatus").value;
                const carImage = document.getElementById("carImage").value;

                const car = {
                    name: carName,
                    brand: brand,
                    model: model,
                    year: year,
                    car_type: carType,
                    daily_rent_price: dailyRentPrice,
                    availability_status: availabilityStatus,
                    image: carImage,
                };

                console.log(car);
            }
        </script>
    @endsection
</x-admin>

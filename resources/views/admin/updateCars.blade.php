<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-2xl font-bold mb-10">Update Car : <span id="upId"></span></h1>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="updateCars(event)" class="grid gap-4">
                <div>
                    <label for="carName" class="block text-gray-700">Car Name</label>
                    <input type="text" id="upName" class="w-full p-2 border border-gray-300 rounded-md" value="Toyota"
                           required/>
                </div>
                <div>
                    <label for="brand" class="block text-gray-700">Brand</label>
                    <input type="text" id="upBrand" class="w-full p-2 border border-gray-300 rounded-md" value="Toyota"
                           required/>
                </div>
                <div>
                    <label for="model" class="block text-gray-700">Model</label>
                    <input type="text" id="upModel" class="w-full p-2 border border-gray-300 rounded-md" value="Camry"
                           required/>
                </div>
                <div>
                    <label for="year" class="block text-gray-700">Year of Manufacture</label>
                    <input type="number" id="upYear" class="w-full p-2 border border-gray-300 rounded-md" value="2020"
                           required/>
                </div>
                <div>
                    <label for="carType" class="block text-gray-700">Car Type</label>
                    <input type="number" id="upCarType" class="w-full p-2 border border-gray-300 rounded-md" value="1"
                           required/>
                </div>

                <div>
                    <label for="dailyRentPrice" class="block text-gray-700">Daily Rent Price</label>
                    <input type="number" id="upDailyRentPrice" min="0"
                           class="w-full p-2 border border-gray-300 rounded-md" value="1000" required/>
                </div>
                <div>
                    <label for="availabilityStatus" class="block text-gray-700">Availability Status</label>
                    <select id="upAvailabilityStatus" value="Available"
                            class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                    </select>
                </div>
                <div>
                    <label for="carImage" class="block text-gray-700">Car Image URL</label>
                    <input type="url" id="upImage" class="w-full p-2 border border-gray-300 rounded-md"/>
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
            document.getElementById("upId").innerHTML = params.get("id");

            function updateCars(event) {
                event.preventDefault();
                const carName = document.getElementById("upName").value;
                const brand = document.getElementById("upBrand").value;
                const model = document.getElementById("upModel").value;
                const year = document.getElementById("upYear").value;
                const carType = document.getElementById("upCarType").value;
                const dailyRentPrice = document.getElementById("upDailyRentPrice").value;
                const availabilityStatus = document.getElementById("upAvailabilityStatus").value;
                const carImage = document.getElementById("upImage").value;

                const updateCar = {
                    name: carName,
                    brand: brand,
                    model: model,
                    year: year,
                    car_type: carType,
                    daily_rent_price: dailyRentPrice,
                    availability_status: availabilityStatus,
                    image: carImage,
                };

                console.log(updateCar);
            }
        </script>
    @endsection
</x-admin>

<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20">
        <h1 class="text-2xl font-bold mb-5">Add Car</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form onsubmit="addCars(event)" class="grid gap-4">
                <div>
                    <label for="carName" class="block text-gray-700">Car Name</label>
                    <input type="text" name="carName" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="brand" class="block text-gray-700">Brand</label>
                    <input type="text" name="brand" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="model" class="block text-gray-700">Model</label>
                    <input type="text" name="model" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="year" class="block text-gray-700">Year of Manufacture</label>
                    <input type="number" name="year" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="carType" class="block text-gray-700">Car Type</label>
                    <input type="text" name="carType" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>

                <div>
                    <label for="dailyRentPrice" class="block text-gray-700">Daily Rent Price</label>
                    <input type="number" name="dailyRentPrice" min="0"
                           class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="availabilityStatus" class="block text-gray-700">Availability Status</label>
                    <select name="availabilityStatus" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <div>
                    <label for="carImage" class="block text-gray-700">Car Image URL</label>
                    <input type="url" name="carImage" class="w-full p-2 border border-gray-300 rounded-md"/>
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
                showLoader();
                let form = event.target;

                let car = {
                    name: form.carName.value,
                    brand: form.brand.value,
                    model: form.model.value,
                    year: form.year.value,
                    car_type: form.carType.value,
                    daily_rent_price: form.dailyRentPrice.value,
                    availability: form.availabilityStatus.value,
                    image: form.carImage.value,
                };

                axios
                    .post("/api/admin/addCar", car)
                    .then((res) => {
                        showLoader(false);
                        event.target.reset();
                        toaster("Car Added Successfully");
                    })
                    .catch((error) => {
                        showLoader(false);
                        toaster("Something went wrong");
                    });
            }
        </script>
    @endsection
</x-admin>

<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-2xl font-bold mb-10">Update Car : <span id="upId"></span></h1>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form id="updateCarForm" onsubmit="updateCars(event)" class="grid gap-4">
                <div>
                    <label for="carName" class="block text-gray-700">Car Name</label>
                    <input type="text" name="upName" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="brand" class="block text-gray-700">Brand</label>
                    <input type="text" name="upBrand" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="model" class="block text-gray-700">Model</label>
                    <input type="text" name="upModel" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="year" class="block text-gray-700">Year of Manufacture</label>
                    <input type="number" name="upYear" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="carType" class="block text-gray-700">Car Type</label>
                    <input type="text" name="upCarType" class="w-full p-2 border border-gray-300 rounded-md"
                           required/>
                </div>

                <div>
                    <label for="dailyRentPrice" class="block text-gray-700">Daily Rent Price</label>
                    <input type="number" name="upDailyRentPrice" min="0"
                           class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="availabilityStatus" class="block text-gray-700">Availability Status</label>
                    <select name="upAvailabilityStatus" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <div>
                    <label for="carImage" class="block text-gray-700">Car Image URL</label>
                    <input type="url" name="upImage" class="w-full p-2 border border-gray-300 rounded-md"/>
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

            async function getCarInfo() {
                showLoader();
                let form = document.getElementById("updateCarForm");
                let res = await axios.get(`/api/admin/carDetails/${params.get("id")}`);
                let carInfo = res.data.data[0];

                document.getElementById("upId").innerHTML = carInfo.name;
                form.upName.value = carInfo.name;
                form.upBrand.value = carInfo.brand;
                form.upModel.value = carInfo.model;
                form.upYear.value = carInfo.year;
                form.upCarType.value = carInfo.car_type;
                form.upDailyRentPrice.value = carInfo.daily_rent_price;
                form.upAvailabilityStatus.value = carInfo.availability === 1 ? "Available" : "Not Available";
                form.upImage.value = carInfo.image;
                showLoader(false)
            }

            function updateCars(event) {
                event.preventDefault();
                showLoader();
                let form = event.target;

                let updateCar = {
                    name: form.upName.value,
                    brand: form.upBrand.value,
                    model: form.upModel.value,
                    year: form.upYear.value,
                    car_type: form.upCarType.value,
                    daily_rent_price: form.upDailyRentPrice.value,
                    availability: form.upAvailabilityStatus.value,
                    image: form.upImage.value
                };

                axios
                    .post(`/api/admin/updateCar/${params.get("id")}`, updateCar)
                    .then((res) => {
                        showLoader(false);
                        window.location.href = "/admin/car-manage";
                        toaster("Car Updated Successfully");
                    })
                    .catch((error) => {
                        showLoader(false);
                        toaster("Something went wrong");
                    });
            }

            getCarInfo()
        </script>
    @endsection
</x-admin>

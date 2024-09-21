<x-layout>
    <div>
        <section class="container mx-auto mt-8 p-4 bg-white rounded-md shadow">
            <h2 class="text-xl font-semibold mb-4">Browse Cars</h2>
            <form class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="car-type" class="block text-sm font-medium text-gray-700">Car Type</label>
                    <select id="car-type"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"></select>
                </div>

                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <select id="brand"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"></select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Daily Rent Price</label>
                    <input type="number" id="price" min="0"
                           class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"
                           placeholder="Enter max price"/>
                </div>
            </form>
        </section>

        <section class="container mx-auto mt-8 p-4 bg-white rounded-md shadow">
            <h2 class="text-xl font-semibold mb-4">Available Cars</h2>
            <div id="car-list" class="grid grid-cols-4 gap-4"></div>
        </section>

        <dialog id="booking-modal" class="modal">
            <div class="modal-box">
                <form method="dialog" class="relative">
                    <button class="btn btn-sm btn-circle btn-ghost text-lg text-error font-bold absolute right-0 top-0">
                        ✕
                    </button>
                </form>
                <h3 id="car-name" class="text-xl font-bold"></h3>
                <div class="mx-auto py-4 relative w-fit">
                    <input id="carID" type="hidden"/>
                    <input type="text" id="bookedDates" placeholder="Select Dates"
                           class="mt-1 block w-full p-2 m-2 border border-gray-300 rounded-md shadow-sm"/>
                </div>
                <div class="text-center">
                    <button type="submit" onclick="confirmBooking()"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Confirm Booking
                    </button>
                </div>
            </div>
        </dialog>
    </div>


    @section('script')
        <script>
            async function fetchCars() {
                const carList = document.getElementById("car-list");
                const carType = document.getElementById("car-type").value;
                const brand = document.getElementById("brand").value;
                const priceFilter = document.getElementById("price").value;

                carList.innerHTML = "";

                try {
                    let res = await axios.get("./sample/cars.json");

                    const filteredCars = res.data.filter((car) => {
                        const matchesType = !carType || car.car_type === carType;
                        const matchesBrand = !brand || car.brand === brand;
                        const matchesPrice = !priceFilter || car.daily_rent_price == priceFilter;
                        return matchesType && matchesBrand && matchesPrice;
                    });

                    filteredCars.forEach((car) => {
                        carList.innerHTML += `<div class="bg-white shadow-md rounded-lg p-4">
                              <img src="${car.image}" alt="Car" class="w-full h-40 object-cover rounded-md mb-4" />
                              <h3 class="text-lg font-semibold">${car.name}</h3>
                              <p class="text-gray-700"><span class="font-bold">Type:</span> ${car.car_type}</p>
                              <p class="text-gray-700"><span class="font-bold">Brand:</span> ${car.brand}</p>
                              <p class="text-gray-700"><span class="font-bold">Rent:</span> $${car.daily_rent_price}/day</p>
                              <button data-id="${car.id}" data-name="${car.name}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 booking">Book Now</button>
                            </div>`;
                    });

                    bookingDates();
                } catch (error) {
                    console.error("Error fetching cars:", error);
                }
            }


            async function brandsAndTypes() {
                const carType = document.getElementById("car-type");
                const brand = document.getElementById("brand");

                try {
                    let res = await axios.get("sample/cars.json");

                    const brandOptions = new Set();
                    const carTypeOptions = new Set();

                    res.data.forEach((car) => {
                        brandOptions.add(car.brand);
                        carTypeOptions.add(car.car_type);
                    });

                    brand.innerHTML = generateOptions(brandOptions, "All Brands");
                    carType.innerHTML = generateOptions(carTypeOptions, "All Types");
                } catch (error) {
                    console.error("Error fetching brands and types:", error);
                }
            }


            function generateOptions(options, defaultOption) {
                let html = `<option value="">${defaultOption}</option>`;
                options.forEach((option) => {
                    html += `<option value="${option}">${option}</option>`;
                });
                return html;
            }

            function initEventListeners() {
                document.getElementById("car-type").addEventListener("change", fetchCars);
                document.getElementById("brand").addEventListener("change", fetchCars);
                document.getElementById("price").addEventListener("input", fetchCars);
            }

            function bookingDates() {
                const bookingButtons = document.getElementsByClassName("booking");
                const bookingModal = document.getElementById("booking-modal");
                const carID = document.getElementById("carID");
                const closeName = document.getElementById("car-name");

                Array.from(bookingButtons).forEach((button) => {
                    button.addEventListener("click", function () {
                        carID.value = this.getAttribute("data-id");
                        closeName.innerHTML = this.getAttribute("data-name");
                        dateBooked(carID.value);
                        bookingModal.showModal();
                    });
                });
            }

            function confirmBooking() {
                const bookingModal = document.getElementById("booking-modal");
                const carID = document.getElementById("carID").value;
                const bookedDates = document.getElementById("bookedDates").value.split(" to ");

                let bookingDetails = {
                    carID: carID,
                    startDate: bookedDates[0],
                    endDate: bookedDates[1],
                };

                flatpickr("#bookedDates").clear();
                console.log(bookingDetails);
                bookingModal.close();
            }

            async function dateBooked(id) {
                try {
                    let res = await axios.get("sample/rental.json");

                    const disabledDates = res.data
                        .filter((date) => date.carID == id)
                        .map((date) => ({
                            from: date.startDate,
                            to: date.endDate,
                        }));

                    flatpickr("#bookedDates", {
                        mode: "range",
                        dateFormat: "Y-m-d",
                        disable: disabledDates,
                        static: true,
                        inline: true,
                    });
                } catch (error) {
                    console.error("Error disabling dates:", error);
                }
            }

            brandsAndTypes();
            fetchCars();
            initEventListeners();
        </script>
    @endsection

</x-layout>





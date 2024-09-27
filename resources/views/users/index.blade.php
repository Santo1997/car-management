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
                    <input id="carCost" type="hidden"/>
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

            function redirectToLogin() {
                toaster("Please login first!", false);
                window.location.href = "/login";
            }

            async function fetchCars() {
                showLoader();

                let carType = document.getElementById("car-type").value;
                let brand = document.getElementById("brand").value;
                let priceFilter = document.getElementById("price").value;
                let parsedPrice = parseFloat(priceFilter).toFixed(2);


                try {
                    let res = await axios.get("/api/cars");
                    let carData = res.data.data;

                    const filteredCars = carData.filter((car) => {
                        const matchesType = !carType || car.car_type === carType;
                        const matchesBrand = !brand || car.brand === brand;
                        const matchesPrice = !priceFilter || car.daily_rent_price === parsedPrice;
                        return matchesType && matchesBrand && matchesPrice;
                    });

                    if (filteredCars.length > 0) {
                        carDetails(filteredCars)
                    } else {
                        document.getElementById("car-list").innerHTML = "Not Available";
                    }


                    bookingDates();
                    showLoader(false);
                } catch (error) {
                    console.error("Error fetching cars:", error);
                }
            }

            async function brandsAndTypes() {
                let carType = document.getElementById("car-type");
                let brand = document.getElementById("brand");

                try {
                    let res = await axios.get("/api/cars");
                    let carData = res.data.data;
                    const brandOptions = new Set();
                    const carTypeOptions = new Set();

                    carData.forEach((car) => {
                        brandOptions.add(car.brand);
                        carTypeOptions.add(car.car_type);
                    });

                    brand.innerHTML = generateOptions(brandOptions, "All Brands");
                    carType.innerHTML = generateOptions(carTypeOptions, "All Types");
                } catch (error) {
                    console.error("Error fetching brands and types:", error);
                }
            }

            function carDetails(filteredCars) {
                let authUser = @json(Auth::user());
                let carList = document.getElementById("car-list");

                carList.innerHTML = " ";
                filteredCars.forEach((car) => {
                    carList.innerHTML += `
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <img src="${car.image}" alt="Car" class="w-full h-40 object-cover rounded-md mb-4" />
                        <h3 class="text-lg font-semibold">${car.name}</h3>
                        <p class="text-gray-700"><span class="font-bold">Type:</span> ${car.car_type}</p>
                        <p class="text-gray-700"><span class="font-bold">Brand:</span> ${car.brand}</p>
                        <p class="text-gray-700"><span class="font-bold">Rent:</span> $${car.daily_rent_price}/day</p>
                        ${authUser !== null
                        ? `<button data-id="${car.id}" data-name="${car.name}" data-cost="${car.daily_rent_price}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 booking">Book Now</button>`
                        : `<button onclick="redirectToLogin()" class="mt-4 bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-500">Book Now</button>`
                    }
                    </div>
                    `;
                });
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
                let bookingButtons = document.getElementsByClassName("booking");
                let bookingModal = document.getElementById("booking-modal");
                let carID = document.getElementById("carID");
                let carCost = document.getElementById("carCost");
                let closeName = document.getElementById("car-name");

                Array.from(bookingButtons).forEach((button) => {
                    button.addEventListener("click", function () {
                        carID.value = this.getAttribute("data-id");
                        carCost.value = this.getAttribute("data-cost");
                        closeName.innerHTML = this.getAttribute("data-name");
                        dateBooked(carID.value);
                        bookingModal.showModal();
                    });
                });
            }

            function confirmBooking() {
                showLoader();
                let bookingModal = document.getElementById("booking-modal");
                let carID = document.getElementById("carID").value;
                let carCost = document.getElementById("carCost").value;
                let bookedDates = document.getElementById("bookedDates").value.split(" to ");

                let bookingDetails = {
                    "car_id": carID,
                    "start_date": bookedDates[0],
                    "end_date": bookedDates[1],
                    "cost": carCost
                }

                flatpickr("#bookedDates").clear();

                axios
                    .post("/api/createRental", bookingDetails)
                    .then((response) => {
                        if (response.data.msg === "success") {
                            toaster("Car booked successfully");
                        } else {
                            toaster("Login First", false);
                            window.location.href = "/login";
                        }
                    })
                    .catch((error) => {
                        toaster("Something went wrong", false);
                    })
                    .finally(() => {
                        showLoader(false);
                        bookingModal.close();
                    })

            }

            async function dateBooked(id) {
                showLoader();
                try {
                    let res = await axios.get("/api/rentals");
                    let rentalData = res.data.data;

                    const disabledDates = rentalData
                        .filter((date) => date.car_id === parseInt(id))
                        .map((date) => ({
                            from: date.start_date,
                            to: date.end_date,
                        }));

                    flatpickr("#bookedDates", {
                        mode: "range",
                        dateFormat: "Y-m-d",
                        minDate: "today",
                        disable: disabledDates,
                        static: true,
                        inline: true,
                    });
                    showLoader(false);
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





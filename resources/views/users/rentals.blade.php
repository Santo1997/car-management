<x-layout>
    <div class="min-h-[calc(100vh-80px)]">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Manage Bookings</h1>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Current Bookings</h2>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra text-center">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Selected Cars</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="current-bookings">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Past Bookings</h2>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra text-center">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Selected Cars</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="past-bookings"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>

            function tableRow(rent) {
                let isDisabled = (rent.status === "Ongoing" || rent.status === "Completed") ? 'disabled="disabled"' : '';

                const row = `
                    <tr>
                      <td>
                        <div class="avatar">
                          <div class="w-16 rounded">
                            <img src="${rent.car?.image}" />
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="flex justify-center items-center gap-3">
                          <div class="text-left">
                            <div class="font-bold">${rent.car?.name}</div>
                            <div class="text-sm opacity-50">${rent.car?.car_type} ,  ${rent.car?.brand}</div>
                          </div>
                        </div>
                      </td>
                      <td>${rent.start_date}</td>
                      <td>${rent.end_date}</td>
                      <td>${rent.status}</td>
                      <th><button ${isDisabled} data-id="${rent.id}" class="btn btn-ghost btn-sm bg-error text-white cancelBtn">Cancel</button></th>
                    </tr>
                  `;

                return row;
            }

            function updateBookings(rentArray, bookingElement, emptyMessage) {
                if (rentArray.length === 0) {
                    bookingElement.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center">
                                <p class="text-gray-500">${emptyMessage}</p>
                            </td>
                        </tr>
                    `;
                } else {
                    rentArray
                        .map((rent) => {
                            bookingElement.innerHTML += tableRow(rent);
                        });
                }
            }

            async function getRentalCars() {
                showLoader();
                let currentBookings = document.getElementById("current-bookings");
                let pastBookings = document.getElementById("past-bookings");

                currentBookings.innerHTML = " ";
                pastBookings.innerHTML = " ";

                let parts = new Date().toLocaleDateString("en-BD", {
                    timeZone: "Asia/Dhaka",
                    year: "numeric",
                    month: "2-digit",
                    day: "2-digit"
                }).split('/');
                let today = parts[2] + "-" + parts[0] + "-" + parts[1];

                let res = await axios.get("/api/rentalInfo");
                let rentalData = res.data.data;

                rentalData = rentalData.map((rent) => {
                    if (rent.end_date < today) {
                        return {...rent, status: "Completed"};
                    } else if (rent.start_date <= today && today <= rent.end_date) {
                        return {...rent, status: "Ongoing"};
                    } else if (rent.start_date > today) {
                        return {...rent, status: "Pending"};
                    }
                    return rent;
                });

                let currentRent = rentalData.filter((rent) => rent.status === "Ongoing" || rent.status === "Pending");
                let pastRent = rentalData.filter((rent) => rent.status === "Completed");
                let sortedCurrent = currentRent.sort((a, b) => (a.start_date) - (b.start_date))
                let sortedPast = pastRent.sort((a, b) => (b.end_date) - (a.end_date))


                updateBookings(sortedCurrent, currentBookings, "No current bookings");
                updateBookings(sortedPast, pastBookings, "No past bookings");
                showLoader(false);
            }

            document.addEventListener("click", function (event) {
                if (event.target.classList.contains("cancelBtn")) {
                    let id = event.target.getAttribute("data-id");

                    axios
                        .post("/api/deleteRental", {
                            "rental_id": id
                        })
                        .then((res) => {
                            if (res.data.msg === "success") {
                                getRentalCars();
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            });

            getRentalCars();
        </script>
    @endsection

</x-layout>





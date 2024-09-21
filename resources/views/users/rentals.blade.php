<x-layout>
    <div class="min-h-[calc(100vh-80px)]">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Manage Bookings</h1>
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Current Bookings</h2>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                            <tr>
                                <th>Selected Cars</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="current-bookings"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-gray-700 mb-2">Past Bookings</h2>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                            <tr>
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
            async function getRentalCars() {
                let currentBookings = document.getElementById("current-bookings");
                let pastBookings = document.getElementById("past-bookings");

                let res = await axios.get("./sample/rental.json");
                console.log(res.data);

                let today = new Date().toISOString().split("T")[0];

                res.data = res.data.map((rent) => {
                    if (rent.endDate < today) {
                        return {...rent, status: "Complete"};
                    } else if (rent.startDate <= today && today <= rent.endDate) {
                        return {...rent, status: "Running"};
                    } else if (rent.startDate > today) {
                        return {...rent, status: "Pending"};
                    }
                    return rent;
                });

                let currentRent = res.data.filter((rent) => rent.status === "Running" || rent.status === "Pending");
                let pastRent = res.data.filter((rent) => rent.status === "Complete");

                currentRent.map((rent) => {
                    currentBookings.innerHTML += tableRow(rent);
                });

                pastRent
                    .sort((a, b) => new Date(b.endDate) - new Date(a.endDate))
                    .map((rent) => {
                        pastBookings.innerHTML += tableRow(rent);
                    });
            }

            function tableRow(rent) {
                let row = `<tr>
                    <td>
                      <div class="flex items-center gap-3">
                        <div>
                          <div class="font-bold">${rent.carID}</div>
                          <div class="text-sm opacity-50">United States</div>
                        </div>
                      </div>
                    </td>
                    <td>${rent.startDate}</td>
                    <td>${rent.endDate}</td>
                    <td>${rent.status ? rent.status : "Completed"}</td>
                    <th>
                      <button class="btn btn-ghost btn-xs">Cancel</button>
                    </th>
                  </tr>`;

                return row;
            }

            getRentalCars();
        </script>
    @endsection

</x-layout>





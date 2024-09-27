<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">All Rents</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra text-center">
                    <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>Customer Name</th>
                        <th>Car Details</th>
                        <th>Rental Start Date and End Date</th>
                        <th>Total Cost</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="rental-list"></tbody>
                </table>
            </div>
        </div>
    </section>

    @section('script')
        <script>
            async function getRentalList() {
                showLoader();
                let rentList = document.getElementById("rental-list");
                let res = await axios.get("/api/admin/rentals");
                let today = new Date().toISOString().split("T")[0];
                let rentalData = res.data.data;
                rentList.innerHTML = "";

                rentalData = rentalData.map((rent) => {
                    if (rent.end_date < today) {
                        return {...rent, status: "Completed"};
                    } else if (rent.start_date <= today && today <= rent.end_date) {
                        return {...rent, status: "Running"};
                    } else if (rent.start_date > today) {
                        return {...rent, status: "Pending"};
                    }
                    return rent;
                });

                rentalData
                    .sort((a, b) => b.id - a.id)
                    .map((rent) => {
                        rentList.innerHTML += `<tr>
                        <td>${rent.id}</td>
                        <td>${rent.user.name}</td>
                        <td>${rent.car.name}</td>
                        <td>${rent.start_date} - ${rent.end_date}</td>
                        <td>${rent.total_cost}</td>
                        <td>${rent.status}</td>
                        <td>
                          <button data-id="${rent.id}" class="btn btn-error text-white dltRentalBtn">Delete</button>
                        </td>
                      </tr>`;
                        showLoader(false);
                    });
            }

            document.addEventListener("click", function (event) {
                showLoader();
                if (event.target.classList.contains("dltRentalBtn")) {
                    let id = event.target.getAttribute("data-id");

                    axios
                        .post("/api/admin/deleteRental", {
                            "id": id,
                        })
                        .then((res) => {
                            if (res.data.msg === "success") {
                                getRentalList();
                                toaster("Customer Deleted Successfully");
                            }
                        })
                        .catch((err) => {
                            showLoader(false);
                            toaster("Something went wrong");
                        });
                }
            });

            getRentalList();
        </script>
    @endsection
</x-admin>

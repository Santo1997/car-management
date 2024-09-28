<x-admin>
    <section class="container min-h-[calc(100vh-140px)] mx-auto py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-5">All Cars</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Car Image</th>
                        <th>Car Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year of Manufacture</th>
                        <th>Car Type</th>
                        <th>Daily Rent Price</th>
                        <th>Availability Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="car-list"></tbody>
                </table>
            </div>
        </div>
    </section>

    @section('script')
        <script>
            async function getCarList() {
                showLoader();
                let carList = document.getElementById("car-list");
                let res = await axios.get("/api/admin/cars");
                let carData = res.data.data;
                carList.innerHTML = " ";

                carData
                    .sort((a, b) => b.id - a.id)
                    .map((car, idx) => {
                        carList.innerHTML += `<tr>
                        <td>${idx + 1}</td>
                        <td>
                          <div class="avatar">
                            <div class="w-16 rounded">
                              <img src="${car.image}" />
                            </div>
                          </div>
                        </td>
                        <td>${car.name}</td>
                        <td>${car.brand}</td>
                        <td>${car.model}</td>
                        <td>${car.year}</td>
                        <td>${car.car_type}</td>
                        <td>${car.daily_rent_price}</td>
                        <td>${car.availability ? "Available" : "Not Available"}</td>
                        <td>
                          <a href="/admin/update-car?id=${car.id}" class="btn btn-warning text-white">Edit</a>
                          <button data-id="${car.id}" class="btn btn-error text-white dltBtn">Delete</button>
                        </td>
                      </tr>`;
                    });

                showLoader(false);
            }

            document.addEventListener("click", function (event) {
                if (event.target.classList.contains("dltBtn")) {
                    let id = event.target.getAttribute("data-id");
                    event.stopPropagation();
                    showLoader();

                    axios
                        .post("/api/admin/deleteCar", {
                            "id": id,
                        })
                        .then((res) => {
                            getCarList();
                            toaster("Car Deleted Successfully");
                        })
                        .catch((err) => {
                            toaster("Something went wrong", false);
                        })
                        .finally(() => {
                            showLoader(false);
                        });
                }
            });

            getCarList();
        </script>
    @endsection
</x-admin>

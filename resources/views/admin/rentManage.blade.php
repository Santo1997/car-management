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
                    <tbody id="car-list"></tbody>
                </table>
            </div>
        </div>
    </section>

    @section('script')
        <script>
            async function getCarList() {
                let carList = document.getElementById("car-list");
                let res = await axios.get("../../sample/cars.json");
                console.log(res.data);
                res.data.map((car) => {
                    carList.innerHTML += `<tr>
                        <td>${car.id}</td>
                        <td>${car.name}</td>
                        <td>${car.brand}</td>
                        <td>${car.model}</td>
                        <td>${car.year}</td>
                        <td>${car.availability}</td>
                        <td>
                          <a href="./updateRental.html?id=${car.id}" class="btn btn-warning text-white">Edit</a>
                          <button class="btn btn-error text-white dltBtn">Delete</button>
                        </td>
                      </tr>`;
                });
            }

            getCarList();
        </script>
    @endsection
</x-admin>

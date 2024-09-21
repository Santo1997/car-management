<x-admin>
    <section class="container min-h-[calc(100vh-56px)] mx-auto pt-20 pb-10">
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
                let carList = document.getElementById("car-list");
                let res = await axios.get("../../sample/cars.json");
                console.log(res.data);
                res.data.map((car) => {
                    carList.innerHTML += `<tr>
                        <td>${car.id}</td>
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
                        <td>${car.availability}</td>
                        <td>
                          <a href="/admin/update-car?id=${car.id}" class="btn btn-warning text-white">Edit</a>
                          <button class="btn btn-error text-white dltBtn">Delete</button>
                        </td>
                      </tr>`;
                });
            }

            getCarList();
        </script>
    @endsection
</x-admin>

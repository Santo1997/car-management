<x-admin>
    <section class="container min-h-[calc(100vh-140px)] mx-auto py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">All Customers</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table table-zebra text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="customer-list"></tbody>
                </table>
            </div>
        </div>
    </section>

    @section('script')
        <script>
            async function getCustomerList() {
                showLoader();
                let customerList = document.getElementById("customer-list");
                let res = await axios.get("/api/admin/customers");
                let customerData = res.data.data;

                customerList.innerHTML = " ";

                customerData
                    .sort((a, b) => b.id - a.id)
                    .map((customer, idx) => {
                        customerList.innerHTML += `<tr>
                            <td>${idx + 1}</td>
                            <td>${customer.name}</td>
                            <td>${customer.email}</td>
                            <td>${customer.phone}</td>
                            <td>${customer.address}</td>
                            <td>
                                <a href="/admin/update-customer?id=${customer.id}" class="btn btn-warning text-white">Edit</a>
                                <button data-id="${customer.id}" class="btn btn-error text-white dltCustomer">Delete</button>
                            </td>
                        </tr>`;
                    });

                showLoader(false);
            }

            document.addEventListener("click", function (event) {
                if (event.target.classList.contains("dltCustomer")) {
                    let id = event.target.getAttribute("data-id");
                    event.stopPropagation();
                    showLoader();

                    axios
                        .post("/api/admin/deleteCustomer", {
                            "id": id,
                        })
                        .then((res) => {
                            getCustomerList();
                            toaster("Customer Deleted Successfully");
                        })
                        .catch((err) => {
                            toaster("Something went wrong");
                        })
                        .finally(() => {
                            showLoader(false);
                        });
                }
            });

            getCustomerList();
        </script>
    @endsection
</x-admin>

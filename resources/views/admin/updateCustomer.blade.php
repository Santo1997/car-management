<x-admin>
    <section class="container min-h-[calc(100vh-140px)] mx-auto py-10">
        <h1 class="text-2xl font-bold mb-10">Update Customer : <span id="ucId"></span></h1>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8 ms-10 max-w-2xl">
            <form id="updateCustomerForm" onsubmit="updateCustomer(event)" class="grid gap-4">
                <div>
                    <label for="upCustomer" class="block text-gray-700">Customer Name</label>
                    <input type="text" id="upCustomer" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="upRole" class="block text-gray-700">Customer Role</label>
                    <select id="upRole" class="w-full p-2 border border-gray-300 rounded-md">
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" class="w-full p-2 border border-gray-300 rounded-md" readonly
                           disabled/>
                </div>
                <div>
                    <label for="upPhone" class="block text-gray-700">Phone Number</label>
                    <input type="text" id="upPhone" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="upAddress" class="block text-gray-700">Address</label>
                    <input type="text" id="upAddress" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>
                <div>
                    <label for="upPass" class="block text-gray-700">Password</label>
                    <input type="text" id="upPass" class="w-full p-2 border border-gray-300 rounded-md" required/>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-14 rounded-md">Update Customer</button>
                </div>
            </form>
        </div>
    </section>

    @section('script')
        <script>
            const params = new URLSearchParams(window.location.search);

            async function getCustomerInfo() {
                showLoader();
                let form = document.getElementById("updateCustomerForm");
                let res = await axios.get(`/api/admin/customerDetails/${params.get("id")}`);
                let customerInfo = res.data.data[0];

                document.getElementById("ucId").innerHTML = customerInfo.name;
                form.upCustomer.value = customerInfo.name;
                form.upRole.value = customerInfo.role === "admin" ? "admin" : "customer";
                form.email.value = customerInfo.email;
                form.upPhone.value = customerInfo.phone;
                form.upAddress.value = customerInfo.address;
                form.upPass.value = customerInfo.password;
                showLoader(false)
            }

            function updateCustomer(event) {
                event.preventDefault();
                showLoader();
                let form = event.target;

                let updateCustomer = {
                    name: form.upCustomer.value,
                    role: form.upRole.value,
                    phone: form.upPhone.value,
                    address: form.upAddress.value,
                    password: form.upPass.value,
                };

                axios
                    .post(`/api/admin/updateCustomer/${params.get("id")}`, updateCustomer)
                    .then((res) => {
                        window.location.href = "/admin/customer-manage";
                        toaster("Customer Updated Successfully");
                    })
                    .catch((error) => {
                        toaster("Something went wrong");
                    })
                    .finally(() => {
                        showLoader(false);
                    });
            }

            getCustomerInfo();
        </script>
    @endsection
</x-admin>

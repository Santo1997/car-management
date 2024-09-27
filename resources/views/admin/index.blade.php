<x-admin>
    <section class="min-h-[calc(100vh-56px)] pt-14">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Cars</h2>
                    <p id="totalCars" class="text-4xl font-semibold text-blue-600"></p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Available Cars</h2>
                    <p id="availableCars" class="text-4xl font-semibold text-green-600"></p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Rentals</h2>
                    <p id="totalRentals" class="text-4xl font-semibold text-yellow-500"></p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Earnings ($)</h2>
                    <p id="totalEarnings" class="text-4xl font-semibold text-indigo-600"></p>
                </div>
            </div>
        </div>
    </section>

    @section('script')
        <script>

            async function getTotalDetails() {
                let totalCars = document.getElementById("totalCars");
                let availableCars = document.getElementById("availableCars");
                let totalRentals = document.getElementById("totalRentals");
                let totalEarnings = document.getElementById("totalEarnings");
                let res = await axios.get("/api/admin/totalDetails");
                let totalDetails = res.data.data;
                totalCars.innerHTML = totalDetails.total;
                availableCars.innerHTML = totalDetails.available;
                totalRentals.innerHTML = totalDetails.rentals;
                totalEarnings.innerHTML = totalDetails.earnings;
            }

            getTotalDetails();

        </script>
    @endsection
</x-admin>

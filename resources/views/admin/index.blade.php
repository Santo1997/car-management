<x-admin>
    <section class="min-h-[calc(100vh-56px)] pt-14">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Number of Cars -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Cars</h2>
                    <p class="text-4xl font-semibold text-blue-600">120</p>
                </div>

                <!-- Number of Available Cars -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Available Cars</h2>
                    <p class="text-4xl font-semibold text-green-600">80</p>
                </div>

                <!-- Total Number of Rentals -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Rentals</h2>
                    <p class="text-4xl font-semibold text-yellow-500">200</p>
                </div>

                <!-- Total Earnings -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Total Earnings</h2>
                    <p class="text-4xl font-semibold text-indigo-600">$15,000</p>
                </div>
            </div>
        </div>
    </section>

    @section('script')

    @endsection
</x-admin>

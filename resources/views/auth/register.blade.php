<x-layout>
    <div class="hero bg-base-200 min-h-[calc(100vh-80px)]">
        <div class="hero-content flex-col lg:flex-row-reverse gap-10">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register now</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
            </div>
            <div class="card bg-base-100 w-full max-w-md shrink-0 shadow-2xl">
                <form onsubmit="register(event)" class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" id="user" placeholder="Username" class="input input-bordered" required/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Phone Number</span>
                        </label>
                        <input type="text" id="phone" placeholder="Phone Number" class="input input-bordered" required/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="email" placeholder="email" class="input input-bordered" required/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Address</span>
                        </label>
                        <input type="text" id="address" placeholder="Address" class="input input-bordered" required/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="password" placeholder="password" class="input input-bordered"
                               required/>
                    </div>
                    <div class="form-control w-fit">
                        <label class="label label-text">
                            Have an account? <a href="{{url('/login')}}" class="link link-hover ml-1"> Sign in</a>
                        </label>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Register Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('script')
        <script>
            function register(event) {
                event.preventDefault();
                showLoader();
                let form = event.target;
                let register = {
                    name: form.user.value,
                    phone: form.phone.value,
                    email: form.email.value,
                    address: form.address.value,
                    password: form.password.value
                };

                axios.post('/api/addCustomer', register)
                    .then(res => {
                        toaster(res.data.msg);
                        window.location.href = '/login';
                    })
                    .catch(error => {
                        toaster('Something went wrong', false);
                    })
                    .finally(() => {
                        showLoader(false);
                    })
            }
        </script>
    @endsection

</x-layout>

<x-layout>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse gap-5">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Login now</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <form onsubmit="login(event)" class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="email" placeholder="email" class="input input-bordered" required/>
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
                            Don't have an account? <a href="{{url('/register')}}" class="link link-hover ml-1"> Sign
                                up</a>
                        </label>
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @section('script')
        <script>
            function login(event) {
                showLoader();
                event.preventDefault();
                let form = event.target;

                let user = {
                    email: form.email.value,
                    password: form.password.value
                };

                axios.post('/api/loginUser', user)
                    .then(res => {
                        let user = res.data.data;

                        if (user.role === 'admin') {
                            window.location.href = '/admin';
                        } else {
                            window.location.href = '/';
                        }
                        toaster(res.data.msg);
                    })
                    .catch(error => {
                        toaster(error.response.data.msg, false);
                    })
                    .finally(() => {
                        showLoader(false);
                    })


            }
        </script>
    @endsection

</x-layout>

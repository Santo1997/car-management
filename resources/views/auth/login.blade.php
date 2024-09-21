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
                <div class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" id="email" placeholder="email" class="input input-bordered"
                               value="mail@mail.com"/>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" id="password" placeholder="password" class="input input-bordered"
                               value="123"/>
                    </div>
                    <div class="form-control mt-6">
                        <button onclick="login()" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @section('script')
        <script>
            async function login() {
                loader();
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                try {
                    let res = await axios.post('/userLogin', {
                        email: email,
                        password: password
                    });
                    if (res.status === 200) {
                        let mgs = res.data.msg;
                        window.location.href = '/userDash';
                        toaster(mgs);
                    } else {
                        toaster(res.data.msg, false);
                    }
                } catch (error) {
                    toaster(error.response.data.msg, false);
                } finally {
                    loader(false);
                }
            }
        </script>
    @endsection

</x-layout>

<section class="relative">
    <progress id="loader" class="progress progress-info absolute -bottom-2 left-0 right-0 z-10 hidden"></progress>

    <div id="toast" class="toast toast-top z-50 hidden">
        <div id="toast-icon" class="alert">
            <span id="toast-msg" class="text-white"></span>
        </div>
    </div>
</section>

<script>
    const showLoader = (shouldShow = true) => {
        let loader = document.getElementById('loader').classList;
        shouldShow ? loader.remove('hidden') : loader.add('hidden');
    }

    const toaster = (msg, type = true) => {
        let typeInfo = type ? 'alert-success' : 'alert-error';
        document.getElementById('toast-msg').innerHTML = msg;
        document.getElementById('toast-icon').classList.add(typeInfo);
        let toastify = document.getElementById('toast').classList;


        toastify.remove('hidden');
        setTimeout(function () {
            toastify.add('hidden');
        }, 2500);
    }
</script>


<section class="relative">
    <progress id="loader" class="progress progress-info fixed top-20 left-0 right-0 z-50 hidden"></progress>

    <div id="toast" class="toast toast-top top-16 z-50 hidden">
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
        let toastIcon = document.getElementById('toast-icon').classList;
        let toastify = document.getElementById('toast').classList;

        document.getElementById('toast-msg').innerHTML = msg;
        toastIcon.add(typeInfo);
        toastify.remove('hidden');

        setTimeout(function () {
            toastify.add('hidden');
            toastIcon.remove(typeInfo);
        }, 2500);
    }
</script>


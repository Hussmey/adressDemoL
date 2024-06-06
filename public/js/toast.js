$(document).ready(function () {
    if ("{{ session('success') }}" !== "" || "{{ session('error') }}" !== "") {
        // Wrap the code in a function to ensure that it runs after the DOM is ready
        function showToast() {
            var toastEl = document.querySelector('.toast');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);

                // Show the toast
                toast.show();

                // Automatically hide after 3 seconds
                setTimeout(function () {
                    toast.hide();
                }, 4000);
            }
        }

        // Call the function
        showToast();
    }
});

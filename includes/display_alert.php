<?php 

function displaySessionAlert($key, $title = '', $icon = 'info', $unset = true) {
    if (isset($_SESSION[$key])) {
        $message = is_array($_SESSION[$key]) ? implode(" ", $_SESSION[$key]) : $_SESSION[$key];
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '{$title}',
                    text: '{$message}',
                    icon: '{$icon}',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        ";
        if ($unset) {
            unset($_SESSION[$key]);
        }
    }
}
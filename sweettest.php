<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert2 Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <button id="testAlert">Show Alert</button>

    <script>
        document.getElementById('testAlert').addEventListener('click', function() {
            Swal.fire({
                title: 'Product!',
                text: 'Product Already in Wishlist',
                icon: 'question', // Try different icons: 'success', 'error', 'warning', 'info', 'question'
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>
</html>

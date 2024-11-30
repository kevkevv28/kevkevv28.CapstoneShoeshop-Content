paypal.Buttons({
    createOrder: function (data, actions) {
        // Dynamically set the amount
        const amount = parseFloat($('#total_amount_checkout').val()).toFixed(2) || "0.00";
        return actions.order.create({
            purchase_units: [
                {
                    amount: {
                        value: amount,
                        currency_code: 'PHP',
                    },
                },
            ],
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            const transaction = details.purchase_units[0].payments.captures[0];

            const userId = $('#userid').val();
            const adres = $('#address').val();
            const shoeIds = [];
            const sizes = [];
            const quantities = [];
            const totals = [];

            // Collect data for each shoe
            $("input[name='shoeid[]']").each(function () {
                const shoeId = $(this).val();
                shoeIds.push(shoeId);
                sizes.push($(`#size_${shoeId}`).val());
                quantities.push($(`#qty_${shoeId}`).val());
                totals.push($(`#total_${shoeId}`).val());
            });

            // Send data via AJAX
            $.ajax({
                method: "POST",
                url: "includes/paypal_processor.php",
                data: {
                    transaction_id: transaction.id,
                    transaction_status: transaction.status,
                    user: userId,
                    addres: adres,
                    product_id: shoeIds,
                    sizes: sizes,
                    qtys: quantities,
                    total_shoe: totals,
                },
                success: function (response) {
                    if (response == 1) {
                        window.location.href = "index.php"
                    } else {
                        alert("Failed to process payment.");
                        console.log("Server Response:", response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    console.log("Response Text:", xhr.responseText);
                    alert("An error occurred while processing your payment.");
                },
            });
        });
    },
    onError: function (error) {
        console.error(error);
        alert("An error occurred while processing the payment. Please try again.");
    },
}).render("#paypal-button-container");

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <script src="https://js.stripe.com/v3/"></script>

    <div id="payment-element"></div>
    <button id="submit">Pay</button>

    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        fetch("/create-payment-intent", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({}) // optional, send data if needed
            })
            .then(res => res.json())
            .then(async ({
                clientSecret
            }) => {
                const elements = stripe.elements({
                    clientSecret
                });

                const paymentElement = elements.create("payment", {
                    layout: "tabs", // shows Link, Apple Pay, GPay tabs
                });

                paymentElement.mount("#payment-element");

                document.getElementById("submit").addEventListener("click", async () => {
                    const {
                        error
                    } = await stripe.confirmPayment({
                        elements,
                        confirmParams: {
                            return_url: "{{ url('/success') }}"
                        },
                    });

                    if (error) alert(error.message);
                });
            });
    </script>

</body>

</html>

const handleClick = async (productId) => {
    try {
        const response = await fetch('http://localhost:3000/create-checkout-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                items: [
                    { id: productId, quantity: 1 },
                ]
            })
        });
        
        const data = await response.json();
        window.location = data.url; // Redirect to Stripe Checkout page
    } catch (error) {
        console.error('Error:', error);
    }
};

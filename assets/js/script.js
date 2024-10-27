document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('ccqp_quantity');
    const priceDisplay = document.getElementById('ccqp_price');
    const pricePerUnit = 5;

    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            const quantity = quantityInput.value || 0;
            const totalPrice = quantity * pricePerUnit;
            priceDisplay.textContent = totalPrice;
        });
    }
});

let productBox = document.querySelector('.product_box img')


let selectedColor = document.querySelector("#ccqp_color");
selectedColor.addEventListener('change', () => {
   
    let productImgUrl = productBox.src;
    let cleanedUrl = productImgUrl.replace(/[^\/]+\.jpg$/,selectedColor.value + ".jpg");
    productBox.src = cleanedUrl;
})


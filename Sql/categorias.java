function addToCart(product, price) {
    cart.push({ product, price });
    total += price;
    updateCart();
}

function updateCart() {
    const cartItems = document.getElementById('cartItems');
    cartItems.innerHTML = '';

    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.product} - S/. ${item.price.toFixed(2)}`;
        cartItems.appendChild(li);
    });

    document.getElementById('totalPrice').textContent = `Total: S/. ${total.toFixed(2)}`;
}

function clearCart() {
    cart = [];
    total = 0;
    updateCart();
}

function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(22);
    doc.text("Carrito de Compras", 20, 30);

    let y = 50;
    cart.forEach(item => {
        doc.setFontSize(16);
        doc.text(`${item.product} - S/. ${item.price.toFixed(2)}`, 20, y);
        y += 10;
    });

    doc.setFontSize(18);
    doc.text(`Total: S/. ${total.toFixed(2)}`, 20, y + 10);

    doc.save('carrito_de_compras.pdf');
}
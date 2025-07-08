// tovari.js
document.querySelectorAll('.buy-btn').forEach(button => {
  button.addEventListener('click', (event) => {
    const card = event.target.closest('.product-card');
    const name = card.querySelector('.card-content h3').textContent;
    const price = card.querySelector('.card-content p').textContent;

    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push({ name, price });
    localStorage.setItem('cart', JSON.stringify(cart));

    alert(`${name} добавлен в корзину!`);
  });
});
// basket.js
document.addEventListener('DOMContentLoaded', () => {
  const cartItemsContainer = document.getElementById('cart-items');
  const totalAmount = document.getElementById('total-amount');

  function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartItemsContainer.innerHTML = '';
    let total = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = '<p>Корзина пуста</p>';
      totalAmount.textContent = '0 ₽';
      return;
    }

    cart.forEach((item, index) => {
      const itemPrice = parseInt(item.price.replace(' ', '').replace('₽', ''));
      total += itemPrice;

      const cartItem = document.createElement('div');
      cartItem.className = 'cart-item';
      cartItem.innerHTML = `
        <div class="cart-item__info">
          <div class="cart-item__title">${item.name}</div>
          <div class="cart-item__price">${item.price}</div>
        </div>
        <button class="remove-btn" onclick="removeItem(${index})">Удалить</button>
      `;
      cartItemsContainer.appendChild(cartItem);
    });

    totalAmount.textContent = `${total} ₽`;
  }

  window.removeItem = (index) => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
  }

  loadCart();

  // Обработчик кнопки "Оформить заказ"
  document.querySelector('.checkout-btn').addEventListener('click', () => {
    localStorage.removeItem('cart'); // Очистка корзины
    totalAmount.textContent = '0 ₽';   // Сброс суммы
    alert("Спасибо за заказ!");
    loadCart(); // Перезагрузка интерфейса
  });
});
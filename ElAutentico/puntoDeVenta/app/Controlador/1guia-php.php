<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Carrito de Compras</h1>
    <div id="items" class="items"></div>
    <div id="total" class="total">Total: $0.00</div>
    <button onclick="checkout()">Realizar compra</button>
  </div>
  <script src="script.js"></script>
</body>
</html>

<style>
    body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f4f4f4;
}

.container {
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.items {
  margin-bottom: 20px;
}

.item {
  display: flex;
  justify-content: space-between;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

.total {
  font-weight: bold;
}

button {
  padding: 10px;
  background-color: #4caf50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

</style>

<script>
    const itemsContainer = document.getElementById('items');
const totalContainer = document.getElementById('total');
let cart = [];

function addToCart(item) {
  cart.push(item);
  displayCart();
}

function displayCart() {
  itemsContainer.innerHTML = '';
  let total = 0;

  cart.forEach(item => {
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('item');
    itemDiv.innerHTML = `<span>${item.name}</span><span>$${item.price.toFixed(2)}</span>`;
    itemsContainer.appendChild(itemDiv);
    total += item.price;
  });

  totalContainer.textContent = `Total: $${total.toFixed(2)}`;
}

function checkout() {
  // Aquí puedes implementar la lógica para procesar la compra
  alert('Compra realizada con éxito. Gracias por su compra!');
  cart = [];
  displayCart();
}

// Ejemplo de uso:
const item1 = { name: 'Producto 1', price: 19.99 };
const item2 = { name: 'Producto 2', price: 29.99 };

addToCart(item1);
addToCart(item2);

</script>
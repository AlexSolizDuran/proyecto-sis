import './bootstrap';
import 'bootstrap';

function soloLetras(event) {
    const key = event.key;
    const regex = /^[A-Za-zñÑÀ-ÿ\s]$/; // Permite letras y espacios
    
    // Si la tecla no es una letra o un espacio, previene la entrada
    if (!regex.test(key) && key !== 'Backspace' && key !== 'Tab' && key !== 'Enter') {
        event.preventDefault(); // Previene la entrada de caracteres no permitidos
    }
}

const cart = [];

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const nombre = this.dataset.nombre;
        const precio = parseFloat(this.dataset.precio);

        // Buscar si el producto ya está en el carrito
        const existingProduct = cart.find(item => item.id == id);

        if (existingProduct) {
            existingProduct.cantidad += 1;
            existingProduct.total = existingProduct.cantidad * existingProduct.precio;
        } else {
            // Agregar nuevo producto al carrito
            cart.push({
                id: id,
                nombre: nombre,
                precio: precio,
                cantidad: 1,
                total: precio
            });
        }

        actualizarCarrito();
    });
});
function eliminarProducto(id) {
    // Filtrar el carrito y eliminar el producto con el ID dado
    const index = cart.findIndex(item => item.id == id);
    if (index !== -1) {
        cart.splice(index, 1);
    }
    actualizarCarrito();
}

function actualizarCarrito() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';

    // Iterar sobre los productos en el carrito y mostrarlos en la tabla
    cart.forEach(producto => {
        const row = `
            <tr>
                <td>${producto.nombre}</td>
                <td>$${producto.precio.toLocaleString('es-ES', {minimumFractionDigits: 2})}</td>
                <td>${producto.cantidad}</td>
                <td>$${producto.total.toLocaleString('es-ES', {minimumFractionDigits: 2})}</td>
                <td>
                    <button class="btn btn-danger btn-sm remove-product" data-id="${producto.id}">Eliminar</button>
                </td>
            </tr>`;
        cartItemsContainer.insertAdjacentHTML('beforeend', row);
    });

    // Reasignar el evento click a los botones de eliminar
    document.querySelectorAll('.remove-product').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id; // Obtener el id desde el atributo data-id
            eliminarProducto(id); // Llamar a la función eliminarProducto
        });
    });
}


document.getElementById('send-cart').addEventListener('click', function() {
    if (cart.length === 0) {
        alert('El carrito está vacío. Agrega calzados antes de enviar el pedido.');
        return;
    }

    const pedido = {
        productos: cart.map(producto => ({
            id: producto.id,
            cantidad: producto.cantidad
        }))
    };

    console.log(pedido); // Verificar los datos del pedido

    fetch("{{ route('admin.venta.store') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(pedido)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la red: ' + response.statusText);
        }
        return response.json(); // Aquí estás devolviendo un objeto JSON
    })
    .then(data => {
        // Aquí puedes utilizar la variable `data`
        console.log(data); // Por ejemplo, muestra el contenido de `data` en la consola
    
        // Verifica si la respuesta del servidor indica éxito
        if (data.message) {
            alert(data.message); // Muestra el mensaje devuelto por el servidor
        }
    
        // Vaciar el carrito o realizar otras acciones según lo que necesites
        cart.length = 0; // Vaciar el carrito
        actualizarCarrito(); // Actualizar la vista del carrito
    })
    .catch(error => {
        console.error('Error al enviar el pedido:', error);
        alert('Hubo un problema al enviar el pedido. Inténtalo de nuevo más tarde.');
    });
});

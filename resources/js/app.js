import './bootstrap';
import 'bootstrap';
//filtrar modelo al seleccionar marca
document.addEventListener('DOMContentLoaded', function () {
    const marcaSelect = document.getElementById('cod_marca');
    const modeloSelect = document.getElementById('cod_modelo');

    marcaSelect.addEventListener('change', function () {
        const marcaId = this.value;

        if (marcaId) {
            fetch(`/api/modelos/${marcaId}`)
                .then(response => response.json())
                .then(data => {
                    modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
                    data.forEach(modelo => {
                        const option = document.createElement('option');
                        option.value = modelo.cod;
                        option.textContent = modelo.nombre;
                        modeloSelect.appendChild(option);
                    });
                    modeloSelect.disabled = false;
                })
                .catch(error => console.error('Error:', error));
        } else {
            modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
            modeloSelect.disabled = true;
        }
    });
});
//editar talla
document.addEventListener('DOMContentLoaded', function () {
    const editarTallaModal = document.getElementById('editarTallaModal');

    editarTallaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // El botón que abrió el modal
        const cod = button.getAttribute('data-cod'); // El código de la talla
        const numero = button.getAttribute('data-numero'); // El número de la talla

        // Reemplaza el placeholder en la acción del formulario
        const form = document.getElementById('editarTallaForm');
        form.action = form.action.replace(':cod', cod);

        // Llena el campo con el valor actual
        const editNumero = document.getElementById('edit_numero');
        editNumero.value = numero;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editarModeloModal = document.getElementById('editarModeloModal');

    editarModeloModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const cod = button.getAttribute('data-cod');
        const nombre = button.getAttribute('data-nombre');
        const marcaId = button.getAttribute('data-marca-id');

        // Configura la acción del formulario para enviar a la ruta correcta
        const form = document.getElementById('editarModeloForm');
        form.action = form.action.replace(':cod', cod);

        // Llena los campos con los valores actuales
        document.getElementById('editar_modelo_cod').value = cod;
        document.getElementById('editar_modelo_nombre').value = nombre;
        document.getElementById('editar_modelo_marca').value = marcaId;
    });
});

//editar material
document.addEventListener('DOMContentLoaded', function () {
    const editarTallaModal = document.getElementById('editarMaterialModal');

    editarTallaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // El botón que abrió el modal
        const cod = button.getAttribute('data-cod'); // El código de la talla
        const numero = button.getAttribute('data-nombre'); // El número de la talla

        // Reemplaza el placeholder en la acción del formulario
        const form = document.getElementById('editarMaterialForm');
        form.action = form.action.replace(':cod', cod);

        // Llena el campo con el valor actual
        const editNumero = document.getElementById('edit_nombre');
        editNumero.value = numero;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const editarColorModal = document.getElementById('editarColorModal');
    editarColorModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal
        const cod = button.getAttribute('data-cod'); // Código del color
        const nombre = button.getAttribute('data-nombre'); // Nombre del color

        // Actualizar la acción del formulario con el código del color
        const form = document.getElementById('editarColorForm');
        form.action = form.action.replace(':cod', cod);


        // Colocar el valor actual en el campo de edición
        const editNombre = document.getElementById('edit_nombre');
        editNombre.value = nombre;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const editarMarcaModal = document.getElementById('editarMarcaModal');
    editarMarcaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal
        const cod = button.getAttribute('data-cod'); // Código del Marca
        const nombre = button.getAttribute('data-nombre'); // Nombre del Marca

        // Actualizar la acción del formulario con el código del Marca
        const form = document.getElementById('editarMarcaForm');
        form.action = form.action.replace(':cod', cod);


        // Colocar el valor actual en el campo de edición
        const editNombre = document.getElementById('edit_nombre');
        editNombre.value = nombre;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const editarMarcaModal = document.getElementById('editarPaisModal');
    editarMarcaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal
        const cod = button.getAttribute('data-cod'); // Código del Marca
        const nombre = button.getAttribute('data-nombre'); // Nombre del Marca
        const horma = button.getAttribute('data-horma');

        // Actualizar la acción del formulario con el código del Marca
        const form = document.getElementById('editarPaisForm');
        form.action = form.action.replace(':cod', cod);


        // Colocar el valor actual en el campo de edición
        const editNombre = document.getElementById('edit_nombre');
        const editCod = document.getElementById('edit_cod');
        const edithorma = document.getElementById('edit_horma');

        editNombre.value = nombre;
        editCod.value = cod;
        edithorma.value = horma;
    });
});



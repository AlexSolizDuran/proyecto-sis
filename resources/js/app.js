import './bootstrap';
import 'bootstrap';
//filtrar modelo al seleccionar marca
document.addEventListener('DOMContentLoaded', function () {
    const marcaSelect = document.getElementById('cod_marca');
    const modeloSelect = document.getElementById('cod_modelo');

    // Función para cargar modelos basada en el ID de la marca
    function loadModelos(marcaId, selectedModeloId) {
        if (marcaId) {
            fetch(`/api/modelos/${marcaId}`)
                .then(response => response.json())
                .then(data => {
                    modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
                    
                    // Cargar las opciones de modelo
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
    }

    // Cargar los modelos al cambiar la marca
    marcaSelect.addEventListener('change', function () {
        const marcaId = this.value;
        loadModelos(marcaId, null); // Cargar modelos sin un modelo seleccionado
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
        const codigoColorHex = button.getAttribute('data-codigo_color'); // Código hexadecimal del color

        // Actualizar la acción del formulario con el código del color
        const form = document.getElementById('editarColorForm');
        form.action = form.action.replace(':cod', cod);

        // Colocar el valor actual en el campo de edición
        const editNombre = document.getElementById('edit_nombre');
        editNombre.value = nombre;

        // Colocar el valor del color en el input de tipo color
        const editColor = document.getElementById('codigo_color');
        editColor.value = '#80080'; // Prueba con un valor estático
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


document.addEventListener('DOMContentLoaded', function () {
    const selectDisplay = document.getElementById('select-display');
    const options = document.getElementById('options');
    const selectedColorsContainer = document.getElementById('selected-colors');
    const hiddenInput = document.getElementById('selected_colors'); // Campo oculto
    let selectedColors = hiddenInput.value ? hiddenInput.value.split(',') : []; // Inicializar con los valores existentes

    // Función para crear un cuadro de color visual en el contenedor
    function addColorSquare(colorCode, colorName, colorHex) {
        const colorSquare = document.createElement('div');
        colorSquare.classList.add('color-square');
        colorSquare.dataset.colorCode = colorCode;

        const colorBox = document.createElement('div');
        colorBox.classList.add('color-box');
        colorBox.style.backgroundColor = colorHex;

        const colorNameText = document.createElement('span');
        colorNameText.classList.add('color-name');
        colorNameText.textContent = colorName;

        // Añadir elementos a colorSquare
        colorSquare.appendChild(colorBox);
        colorSquare.appendChild(colorNameText);

        // Añadir el color seleccionado al contenedor
        selectedColorsContainer.appendChild(colorSquare);

        // Evento para eliminar color seleccionado
        colorSquare.addEventListener('click', function () {
            selectedColors = selectedColors.filter(c => c !== colorCode);
            selectedColorsContainer.removeChild(colorSquare);
            // Actualizar el campo oculto después de eliminar
            hiddenInput.value = selectedColors.join(',');
        });
    }

    // Cargar colores seleccionados previamente
    selectedColors.forEach(colorCode => {
        const option = document.querySelector(`.option[data-value="${colorCode}"]`);
        if (option) {
            const colorName = option.textContent.trim();
            const colorHex = option.getAttribute('data-hex');
            addColorSquare(colorCode, colorName, colorHex);
        }
    });

    // Abrir/cerrar opciones al hacer clic en el display
    selectDisplay.addEventListener('click', function () {
        options.style.display = options.style.display === 'none' ? 'block' : 'none';
    });

    // Seleccionar una opción de color
    options.addEventListener('click', function (event) {
        if (event.target.classList.contains('option')) {
            const colorCode = event.target.getAttribute('data-value');
            const colorName = event.target.textContent.trim();
            const colorHex = event.target.getAttribute('data-hex');

            if (!selectedColors.includes(colorCode)) {
                // Añadir color a la lista de seleccionados
                selectedColors.push(colorCode);
                addColorSquare(colorCode, colorName, colorHex);

                // Actualizar el campo oculto con los colores seleccionados
                hiddenInput.value = selectedColors.join(',');
            }
        }
        // Cerrar las opciones después de seleccionar
        options.style.display = 'none';
    });

    // Cerrar el menú de opciones si se hace clic fuera del select
    document.addEventListener('click', function (event) {
        if (!selectDisplay.contains(event.target) && !options.contains(event.target)) {
            options.style.display = 'none';
        }
    });
});



// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "http://localhost/tecweb/practicas/p09/img/img.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    /*var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;*/
    document.getElementById("description").value = JSON.stringify(baseJSON, null, 2);

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

$(document).ready(function() {
    let edit = false; 
    init();
    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
    console.log('jQuery is working!');

    $('#product-result').hide();
  
    // Evento de búsqueda al teclear
    $(document).ready(function() {
        // Capturar el evento 'keyup' para la búsqueda en tiempo real
        $('#search').on('keyup', function() {
            let search = $('#search').val(); // Obtener el valor actual de búsqueda
    
            // Verificar si el valor de búsqueda no está vacío
            if (search !== '') {
                // Realizar una petición AJAX con jQuery
                $.ajax({
                    url: './backend/product-search.php', // Ruta a tu backend
                    type: 'GET',
                    data: { search: search }, // Enviar el valor de búsqueda
                    success: function(response) {
                        try {
                            let productos = JSON.parse(response); // Parsear la respuesta JSON
                            let template = ''; // Plantilla para la tabla de productos
                            let template_bar = ''; // Plantilla para la barra de estado
    
                            // Verificar si hay productos en la respuesta
                            if (Object.keys(productos).length > 0) {
                                productos.forEach(producto => {
                                    // Crear la descripción del producto
                                    let descripcion = `
                                        <li>precio: ${producto.precio}</li>
                                        <li>unidades: ${producto.unidades}</li>
                                        <li>modelo: ${producto.modelo}</li>
                                        <li>marca: ${producto.marca}</li>
                                        <li>detalles: ${producto.detalles}</li>
                                    `;
    
                                    // Agregar el producto a la tabla
                                    template += `
                                        <tr productId="${producto.id}">
                                            <td>${producto.id}</td>
                                            <td>${producto.nombre}</td>
                                            <td><ul>${descripcion}</ul></td>
                                            <td>
                                                <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    `;
    
                                    // Agregar el nombre del producto a la barra de resultados
                                    template_bar += `<li>${producto.nombre}</li>`;
                                });
    
                                // Mostrar la barra de estado si hay productos
                                $('#product-result').addClass('d-block').removeClass('d-none');
    
                                // Insertar los resultados en la barra de resultados
                                $('#container').html(template_bar);  
    
                                // Insertar los productos en la tabla
                                $('#products tbody').html(template);
    
                            } else {
                                // Si no hay productos, ocultar la barra de estado y mostrar mensaje en la tabla
                                $('#product-result').addClass('d-none').removeClass('d-block');
                                $('#products tbody').html('<tr><td colspan="4">No se encontraron productos.</td></tr>');
                            }
                        } catch (error) {
                            console.error('Error al procesar JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la búsqueda:', error);
                    }
                });
            } else {
                // Si el campo de búsqueda está vacío, ocultar los resultados y recargar la tabla completa
                $('#product-result').addClass('d-none').removeClass('d-block');
                location.reload(); // Recargar la página para mostrar todos los productos originales
            }
        });
    });
    
// Función para validar el producto
function validarProducto(producto) {
    // Validar nombre
    if (!producto.nombre || producto.nombre.trim() === "") {
        alert('El nombre es requerido.');
        return false;
    }
    if (producto.nombre.length > 100) {
        alert('El nombre debe tener 100 caracteres o menos.');
        return false;
    }

    // Validar marca
    if (!producto.marca) {
        alert('La marca es requerida.');
        return false;
    }

    // Validar modelo
    var alfanumerico = /^[a-zA-Z0-9]+$/;
    if (producto.modelo.length > 25) {
        alert("El modelo debe tener 25 caracteres o menos.");
        return false;
    } else if (!alfanumerico.test(producto.modelo)) {
        alert("El modelo debe ser alfanumérico.");
        return false;
    }

    // Validar precio
    var precioNumerico = parseFloat(producto.precio);
    if (precioNumerico === 0) {
        alert("El precio no puede ser 0.");
        return false;
    } else if (precioNumerico < 99.99) {
        alert("El precio no puede ser menor a 99.99.");
        return false;
    }

    // Validar unidades
    var unidades = parseInt(producto.unidades, 10);
    if (isNaN(unidades) || unidades < 0) {
        alert("Las unidades son requeridas y deben ser un número mayor o igual a 0.");
        return false;
    }

    // Validar detalles
    if (producto.detalles.length >= 200) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        return false;
    }

    // Validar imagen
    if (!producto.imagen) {
        alert("El path de la imagen es requerido.");
        producto.imagen = 'http://localhost/tecweb/practicas/p09/img/img.png'; // Default image path
    }

    return true; // Si todas las validaciones pasan
}

$('#product-form').submit(e => {
    e.preventDefault();
    $('#product-result').hide(); 

    // Obtener los datos del formulario
    let name = $('#name').val().trim(); // Eliminar espacios en blanco
    let descriptionText = $('#description').val().trim(); // Eliminar espacios en blanco
    const contenedor = $('#container');
    contenedor.html(''); // Limpiar el contenedor antes de mostrar nuevos mensajes

    // Intentar parsear la descripción a JSON
    let description;
    try {
        description = JSON.parse(descriptionText);
    } catch (error) {
        // Mostrar mensaje de error en el contenedor en lugar de una alerta
        let template = `<li class="alert alert-danger">La descripción debe estar en formato JSON válido.</li>`;
        contenedor.html(template); // Mostrar el mensaje en el contenedor
        $('#product-result').show(); // Mostrar el contenedor de resultados
        return; // Salir de la función
    }

    // Validar que la estructura del JSON sea correcta
    if (!description.hasOwnProperty('precio') || 
        !description.hasOwnProperty('unidades') || 
        !description.hasOwnProperty('modelo') || 
        !description.hasOwnProperty('marca') || 
        !description.hasOwnProperty('detalles') || 
        !description.hasOwnProperty('imagen')) {
        let template = `<li class="alert alert-danger">La descripción JSON debe contener los campos correctos: precio, unidades, modelo, marca, detalles, imagen.</li>`;
        contenedor.html(template); // Mostrar el mensaje en el contenedor
        $('#product-result').show(); // Mostrar el contenedor de resultados
        return; // Salir de la función
    }

    // Crear objeto producto
    const producto = {
        nombre: name,
        marca: description.marca,
        modelo: description.modelo,
        precio: description.precio,
        detalles: description.detalles,
        unidades: description.unidades,
        imagen: description.imagen,
        id: $('#productId').val() // ID del producto para editar
    };

    // Validar el producto usando la función de validación
    if (!validarProducto(producto)) {
        return; // Si la validación falla, detener el envío
    }

    // Determinar si estamos en modo editar o agregar
    let url = producto.id ? 'backend/product-edit.php' : 'backend/product-add.php';

    // Convertimos los datos a JSON
    const jsonData = JSON.stringify(producto);

    // Enviar la solicitud AJAX
    $.ajax({
        url: url,
        type: 'POST',
        data: jsonData,
        contentType: 'application/json',
        success: function (response) {
            try {
                const res = JSON.parse(response);
                let template = '';
                if (res.status === "success") {
                    let mensaje = producto.id ? 'Producto ac correctamente' : 'Producto agregado correctamente';
                    template = `<li class="alert alert-success"><strong>${mensaje}</strong></li>`;
                    $('#product-form').trigger('reset'); // Reiniciar el formulario
                    init(); // Reiniciar el estado de la aplicación
                    listarProductos(); // Actualizar la lista de productos
                } else {
                    // Mensaje de error en el contenedor
                    template = `<li class="alert alert-danger">${res.message}</li>`;
                }

                // Mostrar el mensaje en el contenedor
                contenedor.html(template);
                $('#product-result').show(); // Mostrar el contenedor de resultados
            } catch (error) {
                console.error("Error al procesar el JSON:", error);
                let errorTemplate = `<li class="alert alert-danger">Error al procesar la respuesta del servidor.</li>`;
                contenedor.html(errorTemplate); // Mostrar error de procesamiento en el contenedor
                $('#product-result').show(); // Mostrar el contenedor de resultados
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al enviar los datos:', error);
            let errorTemplate = `<li class="alert alert-danger">Error al enviar la solicitud. Inténtalo de nuevo.</li>`;
            contenedor.html(errorTemplate); // Mostrar error de solicitud en el contenedor
            $('#product-result').show(); // Mostrar el contenedor de resultados
        }
    });
});





    
    // Obtener todos los productos
    function listarProductos() {
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function(response) {
                try {
                    let products = JSON.parse(response);
                    let template = '';
                    products.forEach(product => {
                        let descripcion = '';
                        descripcion += '<li>precio: ' + product.precio + '</li>';
                        descripcion += '<li>unidades: ' + product.unidades + '</li>';
                        descripcion += '<li>modelo: ' + product.modelo + '</li>';
                        descripcion += '<li>marca: ' + product.marca + '</li>';
                        descripcion += '<li>detalles: ' + product.detalles + '</li>';
                        template += `

                                <tr productId="${product.id}">
                                    <td>${product.id}</td>
                                    <td><a href="javascript:void(0);" class="product-item">${product.nombre}</a></td>
                                    <td>${descripcion}</td>
                                    <td>
                                        <button class="product-delete btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                        

                        `;
                    });
                    $('#products').html(template);
                } catch (error) {
                    console.error('Error al parsear JSON:', error);
                    console.log('Respuesta recibida:', response);
                }
            }
        });
    }


// Obtener un Producto por ID
$(document).on('click', '.product-item', function() { 
    let element = $(this).closest('tr'); // Obtener la fila más cercana
    let id = $(element).attr('productId'); // Obtener el ID desde el atributo

    console.log("ID del producto: ", id); // Depuración: verifica si el ID se obtiene correctamente

    // Hacemos la petición GET para obtener el producto por su ID
    $.get('backend/product-single.php', { id }, function(response) {   
        console.log("Respuesta del servidor: ", response); // Depuración: muestra la respuesta

        const product = JSON.parse(response);

        // Verificamos si el estado de la respuesta es "success"
        if (product.status === 'success') {
            console.log("Producto encontrado: ", product); // Depuración: muestra el producto encontrado

            $('#name').val(product.producto.nombre); // Rellenar el campo de nombre

            // Convertir los detalles del producto a JSON y mostrarlos en el campo #description
            const description = {
                precio: product.producto.precio,
                unidades: product.producto.unidades,
                modelo: product.producto.modelo,
                marca: product.producto.marca,
                detalles: product.producto.detalles,
                imagen: product.producto.imagen
            };

            // Rellenar el campo de descripción en formato JSON
            $('#description').val(JSON.stringify(description, null, 2)); // Formato JSON bonito
            $('#productId').val(product.producto.id); // Rellenar el ID del producto
            
            edit = true; // Cambiar el estado a edit
        } else {
            alert(product.message);  // En caso de error, muestra el mensaje
        }
    });
});



    // Eliminar un producto
    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Estás seguro de que deseas eliminarlo?')) {
            // Usar e.currentTarget para obtener el botón correcto
            const element = e.currentTarget.closest('tr'); // Cambiar a closest('tr')
            const id = $(element).attr('productId'); // Obtener el ID del producto
            $.post('backend/product-delete.php', {id}, (response) => {
                // Procesar la respuesta del servidor
                const res = JSON.parse(response);
                if (res.status === "success") {
                    alert(res.message); // Mostrar mensaje de éxito
                } else {
                    alert(res.message); // Mostrar mensaje de error
                }
                listarProductos(); // Actualizar la lista de productos después de eliminar
            });
        }
    });

});

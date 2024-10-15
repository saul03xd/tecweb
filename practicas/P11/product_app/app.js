console.log("app.js cargado correctamente");

var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarProducto(e) {
    e.preventDefault();

    // SE OBTIENE EL TÉRMINO DE BÚSQUEDA
    var searchTerm = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            let productos = JSON.parse(client.responseText);
            console.log(productos);  // Verifica que el JSON recibido sea correcto

            if (productos.length > 0) {
                let template = '';
                productos.forEach(producto => {
                    let descripcion = `
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    `;
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                });
                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = "<tr><td colspan='3'>Producto no encontrado</td></tr>";
            }
        }
    };
    client.send("search_term=" + encodeURIComponent(searchTerm));
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // Obtener el JSON desde el textarea y convertirlo a objeto
    var productoJsonString = document.getElementById('description').value;
    var finalJSON;

    // Intentar convertir el JSON y capturar errores de sintaxis
    try {
        finalJSON = JSON.parse(productoJsonString);
    } catch (error) {
        alert("Error en el formato del JSON. Revisa la sintaxis.");
        return;
    }

    // Agregar validaciones para los campos
    if (!validarProducto(finalJSON)) {
        alert("Datos de producto inválidos. Revisa los campos e intenta nuevamente.");
        return;
    }

    // Agregar el nombre del producto
    finalJSON['nombre'] = document.getElementById('name').value;

    // Convertir a JSON y enviar al servidor
    productoJsonString = JSON.stringify(finalJSON, null, 2);
    
    // Crear el objeto de conexión asíncrona al servidor
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            // Opcional: Recargar la lista de productos o dar confirmación al usuario
            buscarProducto(e); // Recargar productos
        }
    client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                const response = JSON.parse(client.responseText);
                
                // Mostrar el mensaje del servidor
                window.alert(response.message);
            }
        };
        
    };
    client.send(productoJsonString);
}

// Función para validar el producto
function validarProducto(producto) {
    // Validar precio (debe ser un número positivo)
    if (typeof producto.precio !== 'number' || producto.precio <= 0) {
        alert("El precio debe ser un número positivo.");
        return false;
    }

    // Validar unidades (debe ser un entero positivo)
    if (!Number.isInteger(producto.unidades) || producto.unidades <= 0) {
        alert("Las unidades deben ser un entero positivo.");
        return false;
    }

    // Validar modelo (debe ser una cadena no vacía)
    if (typeof producto.modelo !== 'string' || producto.modelo.trim() === '') {
        alert("El modelo debe ser una cadena de texto no vacía.");
        return false;
    }

    // Validar marca (debe ser una cadena no vacía)
    if (typeof producto.marca !== 'string' || producto.marca.trim() === '') {
        alert("La marca debe ser una cadena de texto no vacía.");
        return false;
    }

    // Validar detalles (debe ser una cadena no vacía)
    if (typeof producto.detalles !== 'string' || producto.detalles.trim() === '') {
        alert("Los detalles deben ser una cadena de texto no vacía.");
        return false;
    }

    // Validar imagen (debe ser una cadena que representa la URL)
    if (typeof producto.imagen !== 'string' || !producto.imagen.trim().startsWith('img/')) {
        alert("La imagen debe ser una cadena de texto que representa una URL válida que comienza con 'img/'.");
        return false;
    }

    return true; // Todas las validaciones pasaron
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    // Convierte el JSON a string para poder mostrarlo
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}

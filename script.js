document.addEventListener("DOMContentLoaded", function () {
    // ========LOGIN ==========
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        const errorMessage = document.getElementById("errorMessage");

        loginForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();

            if (username === "TallerABC" && password === "Valverde25") {
                window.location.href = "solicitudes.php";
            } else {
                errorMessage.classList.remove("d-none");
            }
        });
    }

    // ========== LÓGICA PARA AGREGAR NUEVA ORDEN ==========
    const form = document.getElementById("formNuevaOrden");
    const tabla = document.getElementById("tablaOrdenes");

    if (form && tabla) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const datos = new FormData(form);
            const cliente = datos.get("cliente").trim();
            const placa = datos.get("placa").trim();
            const fecha_ingreso = datos.get("fecha_ingreso");
            const tipo = datos.get("tipo");
            const observaciones = datos.get("observaciones").trim();
            const estado_pago = datos.get("estado_pago");
            const fecha_final = datos.get("fecha_final");

            // Validación de campos vacíos + feedback visual
            let camposIncompletos = false;
            form.querySelectorAll("input, select").forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add("is-invalid");
                    camposIncompletos = true;
                } else {
                    input.classList.remove("is-invalid");
                }
            });

            if (camposIncompletos) {
                alert("Por favor completa todos los campos obligatorios.");
                return;
            }
            
            // Calcular días de diferencia entre hoy y fecha de ingreso
            const hoy = new Date();
            const ingreso = new Date(fecha_ingreso);
            const diasDiferencia = Math.floor((hoy - ingreso) / (1000 * 60 * 60 * 24));

            let claseFila = "";
            if (fecha_final && estado_pago.toLowerCase() !== "pagado") {
            claseFila = "fila-peligro"; // rojo fuerte
            } else if (diasDiferencia > 7) {
            claseFila = "fila-alerta"; // amarillo fuerte
            }

            // Crear nueva fila con los datos ingresados
            const fila = document.createElement("tr");
            fila.className = claseFila;
            fila.innerHTML = `
                <td>${cliente}</td>
                <td>${placa}</td>
                <td>${fecha_ingreso}</td>
                <td>${tipo}</td>
                <td>${observaciones}</td>
                <td>${estado_pago}</td>
                <td>${fecha_final}</td>
            `;

            // Agregar fila a la tabla
            tabla.appendChild(fila);

            // Resetear formulario
            form.reset();

            // Cerrar el modal
            const modal = bootstrap.Modal.getInstance(document.getElementById("modalOrden"));
            modal.hide();
        });
    }
});

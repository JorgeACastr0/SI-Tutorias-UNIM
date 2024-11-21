// funcion para cambio de pestañas

function showSection(sectionId) {
  // Ocultar todas las secciones
  const sections = document.querySelectorAll(".content-section");
  sections.forEach((section) => section.classList.add("hidden"));

  // Mostrar la sección seleccionada
  const selectedSection = document.getElementById(sectionId);
  selectedSection.classList.remove("hidden");
}

//fin funcion para cambio de pestañas

// Scripts personalizados -->

function mostrarModalEditar(id) {
  // Realiza una solicitud al servidor para obtener los datos del docente
  fetch(`obtenerDocente.php?id=${id}`)
      .then(response => response.json())
      .then(data => {
          // Rellena los campos del formulario con los datos obtenidos
          document.getElementById("id_docente").value = data.Id_Docente;
          document.getElementById("nombre").value = data.Nombre;
          document.getElementById("apellido").value = data.Apellido;
          document.getElementById("email").value = data.Email;
          document.getElementById("contraseña").value = data.Contraseña;

          // Configura el botón de confirmación para enviar los datos actualizados
          document.getElementById("modalConfirmButton").onclick = function () {
              actualizarDocente(data.Id_Docente);
          };

          // Muestra el modal
          const modal = new bootstrap.Modal(document.getElementById('actionModal'));
          modal.show();
      })
      .catch(error => console.error("Error:", error));
}


function mostrarModalEliminar(id) {
  // Guarda el ID del docente en un input oculto del modal
  document.getElementById("deleteDocenteId").value = id;

  // Muestra el modal
  const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
  deleteModal.show();
}

document.getElementById("confirmDeleteButton").addEventListener("click", function () {
  const id = document.getElementById("deleteDocenteId").value;

  fetch("eliminarDocente.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
      },
      body: JSON.stringify({ id }),
  })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Docente eliminado correctamente.");
              location.reload(); // Recarga la página para actualizar la tabla
          } else {
              alert("Error al eliminar el docente: " + data.error);
          }
      })
      .catch(error => console.error("Error:", error));
});


function actualizarDocente(id) {
  const formData = new FormData(document.getElementById("editForm"));
  fetch(`actualizarDocente.php?id=${id}`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      alert("Docente actualizado correctamente");
      location.reload();
    })
    .catch((error) => console.error("Error:", error));
}



// funcion para colapsar el menu desplegable responsive
(function () {
  "use strict";

  document
    .querySelector("#navbarSideCollapse")
    .addEventListener("click", function () {
      document.querySelector(".offcanvas-collapse").classList.toggle("open");
    });
})();

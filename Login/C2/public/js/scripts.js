document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const toggleButton = document.getElementById("toggleSidebar");
  const mainContent = document.getElementById("mainContent");

  sidebar.classList.add("collapsed");
  mainContent.classList.add("collapsed");
  toggleButton.innerHTML = '<i class="bi bi-chevron-right"></i>';

  function updateButtonPosition() {
      if (sidebar.classList.contains("collapsed")) {
          toggleButton.style.left = "5px"; 
      } else {
          toggleButton.style.left = "255px"; 
      }
  }

  toggleButton.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
      mainContent.classList.toggle("collapsed");

      if (sidebar.classList.contains("collapsed")) {
          toggleButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
      } else {
          toggleButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
      }

      updateButtonPosition();
  });

  updateButtonPosition();

  // Función para marcar el enlace activo basado en la URL
  function setActiveLink() {
      const links = document.querySelectorAll(".nav-link");
      links.forEach(link => {
          if (link.href === window.location.href) {
              link.classList.add("active");
          } else {
              link.classList.remove("active");
          }
      });
  }

  // Ejecutar la función para marcar el enlace activo al cargar la página
  setActiveLink();
});

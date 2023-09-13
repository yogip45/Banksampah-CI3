// TOGGLE SHOW PASSWORD
$(document).on("click", ".show-password-button", function () {
  const targetInputId = $(this).data("target");
  const input = $("#" + targetInputId);

  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

// LOADING SCREEN
const loader = document.querySelector(".loader");
window.addEventListener("load", () => {
  loader.classList.add("loader--hidden");
  loader.addEventListener("transitioned", () => {
    document.body.removeChild(document.querySelector(".loader"));
  });
});

// REMOVE ALERT OTOMATIS
window.setTimeout(function () {
  $(".alert")
    .fadeTo(500, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
}, 3000);

//DATA TABLES NASABAH
$(document).ready(function () {
  $("#dataNasabah").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
      sEmptyTable: "Tidak ada data yang tersedia",
    },
    responsive: true,
  });
});

//COPY PASSWORD BARU SETELAH RESET

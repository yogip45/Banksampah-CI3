//AMBIL JENIS SAMPAH DAN HARGA
var jenisSampah = document.getElementById("jenisSampah");
// Mendapatkan elemen input harga
var inputHarga = document.getElementById("inputHarga");
// Menambahkan event listener ketika pilihan jenis sampah berubah
jenisSampah.addEventListener("change", function () {
  // Mendapatkan harga dari atribut data-harga opsi yang dipilih
  var selectedOption = jenisSampah.options[jenisSampah.selectedIndex];
  var harga = selectedOption.getAttribute("data-harga");
  // Mengisi nilai input harga dengan harga yang ditemukan
  inputHarga.value = harga;
});

//AMBIL NASABAH
function pilih_nasabah(nin, nama) {
  inputNin.value = nin;
  inputNama.value = nama;
}

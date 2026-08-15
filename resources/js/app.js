// ================= SIDEBAR =================
document.addEventListener("DOMContentLoaded", () => {
    const check = document.getElementById("check");
    const sidebar = document.getElementById("sidebar");

    if (!check || !sidebar) return;

    check.addEventListener("change", () => {
        if (check.checked) {
            sidebar.classList.remove("-left-[270px]");
            sidebar.classList.add("left-0");
        } else {
            sidebar.classList.add("-left-[270px]");
            sidebar.classList.remove("left-0");
        }
    });
});


// ================= SHOW / HIDE PASSWORD =================
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (!input || !icon) return;

    if (input.type === "password") {
        input.type = "text";

        icon.classList.remove("bx-show");
        icon.classList.add("bx-hide");
    } else {
        input.type = "password";

        icon.classList.remove("bx-hide");
        icon.classList.add("bx-show");
    }
}


// ================= POPUP TAMBAH BARANG =================
function openPopup() {
    const popup = document.getElementById("popupBg");
    const box = document.getElementById("tambahBox");

    if (!popup || !box) return;

    popup.classList.remove("hidden");
    popup.classList.add("flex");

    setTimeout(() => {
        box.classList.remove("opacity-0", "scale-90");
        box.classList.add("opacity-100", "scale-100");
    }, 10);
}


function closePopup() {
    const popup = document.getElementById("popupBg");
    const box = document.getElementById("tambahBox");

    if (!popup || !box) return;

    box.classList.remove("opacity-100", "scale-100");
    box.classList.add("opacity-0", "scale-90");

    setTimeout(() => {
        popup.classList.add("hidden");
        popup.classList.remove("flex");
    }, 300);
}


// ================= POPUP EDIT BARANG =================
function openPopup2(button) {
    if (!button) return;

    const id = button.getAttribute("data-id");
    const nama = button.getAttribute("data-nama");
    const kategori = button.getAttribute("data-kategori");
    const stock = button.getAttribute("data-stock");

    const idInput = document.getElementById("edit_id");
    const barangInput = document.getElementById("edit_barang");
    const kategoriInput = document.getElementById("edit_kategori");
    const stockInput = document.getElementById("edit_stock");

    if (!idInput || !barangInput || !kategoriInput || !stockInput) return;

    idInput.value = id;
    barangInput.value = nama;
    kategoriInput.value = kategori;
    stockInput.value = stock;

    const popup = document.getElementById("popupBg2");
    const box = document.getElementById("editBox");

    if (!popup || !box) return;

    popup.classList.remove("hidden");
    popup.classList.add("flex");

    setTimeout(() => {
        box.classList.remove("opacity-0", "scale-90");
        box.classList.add("opacity-100", "scale-100");
    }, 10);
}


function closePopup2() {
    const popup = document.getElementById("popupBg2");
    const box = document.getElementById("editBox");

    if (!popup || !box) return;

    box.classList.remove("opacity-100", "scale-100");
    box.classList.add("opacity-0", "scale-90");

    setTimeout(() => {
        popup.classList.add("hidden");
        popup.classList.remove("flex");
    }, 300);
}


// ================= KONFIRMASI HAPUS =================
function hapusBarang(event, btn) {
    event.preventDefault();

    Swal.fire({
        title: "Hapus barang?",
        text: "Data yang dihapus tidak dapat dikembalikan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff842c",
        cancelButtonColor: "#555555",
        confirmButtonText: "Ya, hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest("form")?.submit();
        }
    });

    return false;
}


// ================= KONFIRMASI LOGOUT =================
function konfirmasiLogout() {
    Swal.fire({
        title: "Logout dari GudangKu?",
        text: "Anda harus login kembali untuk masuk ke sistem.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff842c",
        cancelButtonColor: "#555555",
        confirmButtonText: "Ya, logout",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logoutForm")?.submit();
        }
    });
}


// ================= GLOBAL FUNCTION =================
// Dibutuhkan karena beberapa function dipanggil lewat onclick="" di Blade.

window.togglePassword = togglePassword;

window.openPopup = openPopup;
window.closePopup = closePopup;

window.openPopup2 = openPopup2;
window.closePopup2 = closePopup2;

window.hapusBarang = hapusBarang;
window.konfirmasiLogout = konfirmasiLogout;

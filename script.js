function tampilkanPesan(teks) {
    alert(teks);
}

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("header form");
    const inputSearch = document.getElementById("search-input");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const keyword = inputSearch.value.trim();
        if (keyword) {
            tampilkanPesan("Kamu mencari produk: " + keyword);
        } else {
            tampilkanPesan("Silakan masukkan kata kunci pencarian!");
        }
    });

    const tentangKami = document.querySelector("#tentang-kami p");

    const teksPendek = "Kami berkomitmen untuk menyediakan produk dan layanan terbaik (klik untuk baca selengkapnya).";
    const teksPanjang = "Kami adalah toko komputer terpercaya yang telah melayani pelanggan sejak lama dengan komitmen penuh terhadap kualitas dan kepuasan pelanggan. Toko hadir tidak hanya sebagai penyedia produk, tetapi juga sebagai mitra teknologi yang siap membantu masyarakat dalam memilih perangkat terbaik sesuai kebutuhan. Dengan beragam pilihan mulai dari laptop, PC rakitan, hingga aksesoris dan layanan perbaikan, kami selalu berusaha menghadirkan solusi yang inovatif dan terjangkau. Didukung oleh tim profesional yang berpengalaman, kami berkomitmen untuk terus berkembang, mengikuti tren terbaru di dunia teknologi, serta memberikan pelayanan ramah, cepat, dan terpercaya bagi setiap pelanggan. Visi kami adalah menjadi pusat solusi komputer yang modern, lengkap, dan dapat diandalkan oleh siapa pun yang ingin mewujudkan pengalaman komputasi terbaik.";

    let isExpanded = false;

    tentangKami.addEventListener("click", function () {
        if (isExpanded) {
            tentangKami.textContent = teksPendek;
            isExpanded = false;
        } else {
            tentangKami.textContent = teksPanjang;
            isExpanded = true;
        }
    });
});

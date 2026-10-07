// script.js - Sehatin Interactive JavaScript
document.addEventListener('DOMContentLoaded', () => {
  // 1. NAVBAR SCROLL EFFECT & ACTIVE SECTION HIGHLIGHT
  const headerNav = document.getElementById('navbar-header');
  const navLinks = document.querySelectorAll('.nav-link');
  const sections = document.querySelectorAll('section[id]');
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  window.addEventListener('scroll', () => {
    // Toggle scrolled navbar state
    if (window.scrollY > 20) {
      headerNav?.classList.add('navbar-scrolled');
    } else {
      headerNav?.classList.remove('navbar-scrolled');
    }

    // Highlight active link berdasarkan posisi scroll pengguna
    let currentSectionId = 'hero';
    const scrollPosition = window.scrollY + 120;

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
        currentSectionId = section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${currentSectionId}`) {
        link.classList.add('active');
      }
    });
  });

  // 2. MOBILE MENU TOGGLE (CLICK EVENT)
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('active');
    });

    // Tutup menu mobile ketika salah satu tautan diklik
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach((link) => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('active');
      });
    });
  }

  //EVENT HANDLING - CLICK, INPUT, & SUBMIT (KALKULATOR BMI & KALORI)
  const calcForm = document.getElementById('bmi-form');
  const tinggiInput = document.getElementById('calc-tinggi');
  const beratInput = document.getElementById('calc-berat');
  const usiaInput = document.getElementById('calc-usia');
  const aktivitasSelect = document.getElementById('calc-aktivitas');
  const calcPlaceholder = document.getElementById('calc-result-placeholder');
  const calcResultBox = document.getElementById('calc-result-box');
  const bmiResultEl = document.getElementById('calc-result-bmi');
  const kategoriResultEl = document.getElementById('calc-result-kategori');
  const kaloriResultEl = document.getElementById('calc-result-kalori');

  let isCalculated = false;

  // A. CLICK EVENT: Navigasi tombol & tautan langsung ke kalkulator dengan efek visual
  const calcTriggerLinks = document.querySelectorAll('a[href="#kalkulator"]');
  calcTriggerLinks.forEach((link) => {
    link.addEventListener('click', () => {
      if (calcForm) {
        calcForm.classList.add('highlight');
        setTimeout(() => {
          calcForm.classList.remove('highlight');
        }, 1200);
      }
    });
  });

  // B. INPUT EVENT: Menangkap aksi ketik/input pengguna tanpa memunculkan hasil otomatis
  const formInputs = [tinggiInput, beratInput, usiaInput, aktivitasSelect];
  formInputs.forEach((input) => {
    input?.addEventListener('input', () => {
      // Jika data telah diubah setelah sebelumnya dihitung,
      // sembunyikan hasil lama dan tampilkan kembali petunjuk submit
      if (isCalculated) {
        if (calcResultBox) calcResultBox.classList.add('hidden');
        if (calcPlaceholder) calcPlaceholder.classList.remove('hidden');
        isCalculated = false;
      }
    });
  });

  //Menghitung & menampilkan hasil hanya ketika user menekan tombol submit
  if (calcForm) {
    calcForm.addEventListener('submit', (event) => {
      event.preventDefault(); // Mencegah reload halaman

      if (!tinggiInput || !beratInput) return;

      const heightCm = parseFloat(tinggiInput.value) || 0;
      const weightKg = parseFloat(beratInput.value) || 0;
      const age = parseFloat(usiaInput?.value || 21);
      const activityMultiplier = parseFloat(aktivitasSelect?.value || 1.375);

      // Validasi data input
      if (heightCm <= 0 || weightKg <= 0 || age <= 0) {
        alert('Silakan masukkan tinggi badan, berat badan, dan usia yang valid!');
        return;
      }

      //Hitung Indeks Massa Tubuh (BMI)
      const heightM = heightCm / 100; //mengubah satuan TB dari cm - m
      const bmi = (weightKg / (heightM * heightM)).toFixed(1); //membagi BB dengan kuadrat TB lalu dibulatkan: 1 angka desimal

      let category = 'Berat Badan Ideal (Normal)';
      let badgeClass = 'badge-ideal';

      if (bmi < 18.5) {
        category = 'Kurang (Underweight)';
        badgeClass = 'badge-underweight';
      } else if (bmi >= 18.5 && bmi <= 24.9) {
        category = 'Berat Badan Ideal (Normal)';
        badgeClass = 'badge-ideal';
      } else if (bmi >= 25 && bmi <= 29.9) {
        category = 'Kelebihan (Overweight)';
        badgeClass = 'badge-overweight';
      } else {
        category = 'Obesitas';
        badgeClass = 'badge-obese';
      }

      // Hitung Estimasi Kalori Harian (Rumus Mifflin-St Jeor)
      const bmr = 10 * weightKg + 6.25 * heightCm - 5 * age + 5;
      const tdee = Math.round(bmr * activityMultiplier);

      // Manipulasi DOM untuk menampilkan hasil perhitungan
      if (bmiResultEl) bmiResultEl.textContent = bmi;
      if (kategoriResultEl) {
        kategoriResultEl.textContent = category;
        kategoriResultEl.className = `result-badge ${badgeClass}`;
      }
      if (kaloriResultEl) {
        kaloriResultEl.textContent = `${tdee.toLocaleString('id-ID')} kcal / hari`;
      }

      // Sembunyikan placeholder dan tampilkan box hasil
      if (calcPlaceholder) calcPlaceholder.classList.add('hidden');
      if (calcResultBox) {
        calcResultBox.classList.remove('hidden');
      }

      isCalculated = true;
    });
  }
});

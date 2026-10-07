// script.js - Sehatin Interactive JavaScript
document.addEventListener('DOMContentLoaded', () => {
  // API program kesehatan: baca konfigurasi JSON, lalu minta data resep dari REST API.
  const programApiStatus = document.getElementById('program-api-status');
  const programApiList = document.getElementById('program-api-list');
  const programApiName = document.getElementById('program-api-name');

  const setProgramApiStatus = (message, state) => {
    if (!programApiStatus) return;

    programApiStatus.textContent = message;
    programApiStatus.className = 'mb-6 text-center text-sm';
    programApiStatus.setAttribute('role', state === 'error' ? 'alert' : 'status');

    if (state === 'error') {
      programApiStatus.classList.add('text-red-700');
    } else if (state === 'success') {
      programApiStatus.classList.add('text-emerald-700');
    } else {
      programApiStatus.classList.add('text-slate-500');
    }
  };

  const showProgramApiError = (message) => {
    if (programApiList) {
      const errorMessage = document.createElement('p');
      errorMessage.className = 'md:col-span-3 rounded-2xl border border-red-200 bg-red-50 p-6 text-center text-sm text-red-700';
      errorMessage.textContent = message;
      programApiList.replaceChildren(errorMessage);
    }
    setProgramApiStatus('Data program tidak dapat ditampilkan.', 'error');
    console.error(message);
  };

  const addRecipeDetail = (card, label, value) => {
    const detail = document.createElement('p');
    detail.className = 'text-xs text-slate-500';
    detail.textContent = `${label}: ${value}`;
    card.append(detail);
  };

  const renderProgramRecipes = (recipes) => {
    if (!programApiList) return;

    // Buat elemen DOM satu per satu agar teks dari API tidak diperlakukan sebagai HTML.
    const recipeCards = recipes.map((recipe) => {
      const card = document.createElement('article');
      card.className = 'overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition-shadow hover:shadow-md';

      const image = document.createElement('img');
      image.className = 'h-48 w-full object-cover';
      image.src = recipe.image;
      image.alt = `Foto ${recipe.name}`;
      image.loading = 'lazy';
      card.append(image);

      const content = document.createElement('div');
      content.className = 'space-y-3 p-6';

      const cuisine = document.createElement('p');
      cuisine.className = 'text-xs font-bold uppercase tracking-wide text-[#007789]';
      cuisine.textContent = `${recipe.cuisine} • ${recipe.mealType.join(', ')}`;
      content.append(cuisine);

      const title = document.createElement('h3');
      title.className = 'text-base font-bold text-slate-900';
      title.textContent = recipe.name;
      content.append(title);

      addRecipeDetail(content, 'Kalori', `${recipe.caloriesPerServing} kcal / sajian`);
      addRecipeDetail(content, 'Waktu memasak', `${recipe.prepTimeMinutes + recipe.cookTimeMinutes} menit`);
      addRecipeDetail(content, 'Bahan', recipe.ingredients.slice(0, 4).join(', '));
      card.append(content);
      return card;
    });

    programApiList.replaceChildren(...recipeCards);
  };

  const loadProgramRecipes = async () => {
    if (!programApiStatus || !programApiList) return;

    setProgramApiStatus('Memuat rekomendasi menu dari API...', 'loading');
    programApiList.replaceChildren();

    let config;
    try {
      // program.json menyimpan nama API dan URL endpoint agar konfigurasi mudah ditemukan.
      const configResponse = await fetch('data/program.json');
      if (!configResponse.ok) {
        throw new Error(`Konfigurasi program gagal dimuat (HTTP ${configResponse.status}).`);
      }

      config = await configResponse.json();
      if (typeof config.apiUrl !== 'string' || typeof config.apiName !== 'string') {
        throw new Error('Konfigurasi data/program.json belum memiliki apiUrl dan apiName yang valid.');
      }
    } catch (error) {
      const message = error instanceof Error
        ? error.message
        : 'Terjadi kesalahan saat membaca konfigurasi data/program.json.';
      showProgramApiError(message);
      return;
    }

    if (programApiName) programApiName.textContent = config.apiName;

    // Fetch ke REST API menerima response JSON, lalu datanya diteruskan ke fungsi render.
    let response;
    try {
      response = await fetch(config.apiUrl);
    } catch (error) {
      showProgramApiError('Tidak dapat terhubung ke API. Periksa koneksi internet, lalu coba lagi.');
      return;
    }

    if (!response.ok) {
      if (response.status === 404) {
        showProgramApiError('Data menu tidak ditemukan (404). Periksa endpoint API pada data/program.json.');
      } else {
        showProgramApiError(`Request API gagal dengan HTTP ${response.status}. Silakan coba lagi nanti.`);
      }
      return;
    }

    let data;
    try {
      data = await response.json();
    } catch (error) {
      showProgramApiError('Response API tidak dapat dibaca sebagai JSON.');
      return;
    }

    if (!Array.isArray(data.recipes)) {
      showProgramApiError('Format response API tidak sesuai: daftar resep tidak ditemukan.');
      return;
    }
    if (data.recipes.length === 0) {
      setProgramApiStatus('Request berhasil, tetapi API belum memiliki data menu untuk ditampilkan.', 'success');
      return;
    }

    renderProgramRecipes(data.recipes);
    setProgramApiStatus(`Berhasil memuat ${data.recipes.length} menu dari API.`, 'success');
  };

  loadProgramRecipes();

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

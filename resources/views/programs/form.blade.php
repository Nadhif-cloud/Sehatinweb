@extends('layouts.app')

@section('title', $formTitle)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">TASK 03 · PROGRAM MANAGEMENT</p>
            <h1>{{ $formTitle }}</h1>
            <p class="muted">Lengkapi nama dan deskripsi program.</p>
        </div>
        <a class="button button-secondary" href="{{ route('programs.index') }}">Kembali ke daftar</a>
    </div>

    <section class="panel form-panel">
        {{-- Form dipakai untuk tambah dan edit; novalidate membiarkan JavaScript menampilkan semua error sekaligus. --}}
        <form id="program-form" method="post" action="{{ $formAction }}" novalidate>
            {{-- Token CSRF melindungi form dari request lintas situs yang tidak sah. --}}
            @csrf
            @if ($formMethod !== 'POST')
                {{-- Browser mengirim POST; directive ini membuat Laravel memprosesnya sebagai PUT. --}}
                @method($formMethod)
            @endif

            <div class="form-field">
                <label for="nama">Nama Program</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama', $program->nama) }}" aria-describedby="nama-help nama-count nama-required-error nama-length-error" required>
                <div class="field-meta">
                    <span id="nama-help" class="field-hint">Nama program maksimal 100 karakter.</span>
                    <span id="nama-count" class="field-count">0/100</span>
                </div>
                <p id="nama-required-error" class="field-error" role="alert" hidden>Nama program wajib diisi.</p>
                <p id="nama-length-error" class="field-error" role="alert" hidden>Nama program maksimal 100 karakter.</p>
                @error('nama') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5" aria-describedby="deskripsi-required-error" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                <p id="deskripsi-required-error" class="field-error" role="alert" hidden>Deskripsi program wajib diisi.</p>
                @error('deskripsi') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button class="button button-primary" type="submit">{{ $formMethod === 'POST' ? 'Simpan Program' : 'Simpan Perubahan' }}</button>
                <a class="button button-secondary" href="{{ route('programs.index') }}">Batal</a>
            </div>
        </form>
    </section>

    @push('scripts')
        <script>
            const namaInput = document.getElementById('nama');
            const namaCount = document.getElementById('nama-count');
            const namaRequiredError = document.getElementById('nama-required-error');
            const namaLengthError = document.getElementById('nama-length-error');
            const deskripsiInput = document.getElementById('deskripsi');
            const deskripsiRequiredError = document.getElementById('deskripsi-required-error');
            const programForm = document.getElementById('program-form');
            const maxNamaLength = 100;
            // Pesan wajib isi baru ditampilkan setelah pengguna mencoba mengirim form.
            let hasSubmitted = false;

            const updateNamaLength = () => {
                const length = [...namaInput.value].length;
                const isTooLong = length > maxNamaLength;
                const isEmpty = namaInput.value.trim() === '';

                // Perbarui penghitung karakter dan status validasi nama secara langsung.
                namaCount.textContent = `${length}/${maxNamaLength}`;
                namaRequiredError.hidden = !hasSubmitted || !isEmpty;
                namaLengthError.hidden = !isTooLong;
                namaInput.setAttribute('aria-invalid', String((hasSubmitted && isEmpty) || isTooLong));
            };

            const updateDeskripsiRequired = () => {
                const isEmpty = deskripsiInput.value.trim() === '';

                deskripsiRequiredError.hidden = !hasSubmitted || !isEmpty;
                deskripsiInput.setAttribute('aria-invalid', String(hasSubmitted && isEmpty));
            };

            namaInput.addEventListener('input', updateNamaLength);
            deskripsiInput.addEventListener('input', updateDeskripsiRequired);
            programForm.addEventListener('submit', (event) => {
                hasSubmitted = true;
                updateNamaLength();
                updateDeskripsiRequired();

                const isNamaInvalid = namaInput.value.trim() === '' || [...namaInput.value].length > maxNamaLength;
                const isDeskripsiInvalid = deskripsiInput.value.trim() === '';

                // Tampilkan semua pesan yang perlu diperbaiki dan tahan form agar tidak terkirim.
                if (isNamaInvalid || isDeskripsiInvalid) {
                    event.preventDefault();
                    (isNamaInvalid ? namaInput : deskripsiInput).focus();
                }
            });

            updateNamaLength();
            updateDeskripsiRequired();
        </script>
    @endpush
@endsection

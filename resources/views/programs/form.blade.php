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
        <form method="post" action="{{ $formAction }}">
            @csrf
            @if ($formMethod !== 'POST')
                @method($formMethod)
            @endif

            <div class="form-field">
                <label for="nama">Nama Program</label>
                <input id="nama" name="nama" type="text" maxlength="255" value="{{ old('nama', $program->nama) }}" required>
                @error('nama') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                @error('deskripsi') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button class="button button-primary" type="submit">{{ $formMethod === 'POST' ? 'Simpan Program' : 'Simpan Perubahan' }}</button>
                <a class="button button-secondary" href="{{ route('programs.index') }}">Batal</a>
            </div>
        </form>
    </section>
@endsection

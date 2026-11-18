@extends('layouts.app')

@section('title', $program->nama)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">DETAIL PROGRAM</p>
            <h1>{{ $program->nama }}</h1>
        </div>
        <a class="button button-secondary" href="{{ route('programs.index') }}">Kembali ke daftar</a>
    </div>
    <section class="panel detail-panel">
        <h2>Deskripsi</h2>
        <p class="detail-description">{{ $program->deskripsi }}</p>
        <a class="button button-edit" href="{{ route('programs.edit', $program) }}">Edit Program</a>
    </section>
@endsection

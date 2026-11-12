@extends('layouts.app')

@section('title', 'Tambah Program')
@section('heading', 'Tambah Program')
@section('subheading', 'Isi nama dan deskripsi program, lalu simpan ke database.')

@section('content')
    <form action="{{ route('programs.store') }}" method="POST" class="mx-auto max-w-[640px] rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" novalidate>
        @include('programs._form', ['submit' => 'Simpan'])
    </form>
@endsection

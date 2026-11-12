@extends('layouts.app')

@section('title', 'Edit Program')
@section('heading', 'Edit Program')
@section('subheading', 'Ubah data program yang sudah ada di database.')

@section('content')
    <form action="{{ route('programs.update', $program) }}" method="POST" class="mx-auto max-w-[640px] rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" novalidate>
        @method('PUT')
        @include('programs._form', ['submit' => 'Update'])
    </form>
@endsection

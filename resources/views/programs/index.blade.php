@extends('layouts.app')

@section('title', 'Kelola Program Sehatin')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">SEHATIN · PROGRAM MANAGEMENT</p>
            <h1>Kelola Program Sehatin</h1>
            <p class="muted">Kelola fitur kesehatan dan konten Sehatin yang tersimpan di database.</p>
        </div>
        <a class="button button-primary" href="{{ route('programs.create') }}">+ Tambah Program</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>Daftar Program</h2>
                <p class="muted">Data ditampilkan langsung dari tabel <code>programs</code>.</p>
            </div>
            <span class="count-badge">{{ $programs->count() }} program</span>
        </div>

        @if ($programs->isEmpty())
            <div class="empty-state">
                <h3>Belum ada program</h3>
                <p class="muted">Tambahkan program pertama untuk melihatnya di daftar ini.</p>
                <a class="button button-primary" href="{{ route('programs.create') }}">Tambah Program</a>
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr><th>No</th><th>Nama Program</th><th>Deskripsi</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                    @foreach ($programs as $index => $program)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="program-name">{{ $program->nama }}</td>
                            <td>{{ $program->deskripsi }}</td>
                            <td>
                                <div class="actions">
                                    <a class="button button-small button-view" href="{{ route('programs.show', $program) }}">Lihat</a>
                                    <a class="button button-small button-edit" href="{{ route('programs.edit', $program) }}">Edit</a>
                                    <form method="post" action="{{ route('programs.destroy', $program) }}" onsubmit="return confirm('Hapus program ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-small button-delete" type="submit">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection

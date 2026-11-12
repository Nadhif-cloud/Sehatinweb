@extends('layouts.app')

@section('title', 'Program Management')
@section('heading', 'Program Sehatin')
@section('subheading', 'Kelola program kesehatan Sehatin. Semua data dibaca langsung dari database.')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-slate-500">Total {{ $programs->count() }} program</p>
        <a href="{{ route('programs.create') }}" class="rounded-full bg-[#007789] px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-[#005a69]">+ Tambah Program</a>
    </div>

    @if ($programs->isEmpty())
        <p class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center text-sm text-slate-600" role="status">Belum ada program untuk ditampilkan.</p>
    @else
        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wide text-[#007789]">
                    <tr>
                        <th class="px-5 py-3.5">No</th>
                        <th class="px-5 py-3.5">Nama Program</th>
                        <th class="px-5 py-3.5">Deskripsi</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($programs as $program)
                        <tr>
                            <td class="px-5 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-semibold text-slate-900">{{ $program->nama }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ \Illuminate\Support\Str::limit($program->deskripsi, 90) }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('programs.edit', $program) }}" class="rounded-full bg-[#007789] px-4 py-1.5 text-xs font-semibold text-white transition-colors hover:bg-[#005a69]">Edit</a>
                                    <button type="button" data-delete data-nama="{{ $program->nama }}" data-action="{{ route('programs.destroy', $program) }}" class="rounded-full bg-red-500 px-4 py-1.5 text-xs font-semibold text-white transition-colors hover:bg-red-600">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <dialog id="delete-dialog" class="m-auto w-[min(92vw,420px)] rounded-2xl border border-slate-200 p-0 shadow-xl backdrop:bg-slate-900/40">
        <form id="delete-form" method="POST" class="space-y-4 p-6">
            @csrf
            @method('DELETE')
            <h2 class="text-base font-bold text-slate-900">Hapus Program</h2>
            <p class="text-sm text-slate-500">Yakin ingin menghapus program ini?</p>
            <p id="delete-nama" class="text-sm font-semibold text-slate-900"></p>
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-full bg-red-500 px-6 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-red-600">Hapus</button>
                <button type="button" id="delete-cancel" class="rounded-full bg-slate-100 px-6 py-2.5 text-sm font-semibold text-slate-600 transition-colors hover:bg-slate-200">Batal</button>
            </div>
        </form>
    </dialog>
@endsection

@push('scripts')
<script>
    (function () {
        var dialog = document.getElementById('delete-dialog');
        var form = document.getElementById('delete-form');
        var nama = document.getElementById('delete-nama');
        var cancel = document.getElementById('delete-cancel');
        if (!dialog || !form || !nama || !cancel || typeof dialog.showModal !== 'function') { return; }

        document.querySelectorAll('[data-delete]').forEach(function (button) {
            button.addEventListener('click', function () {
                form.setAttribute('action', button.getAttribute('data-action'));
                nama.textContent = button.getAttribute('data-nama');
                dialog.showModal();
            });
        });
        cancel.addEventListener('click', function () { dialog.close(); });
    })();
</script>
@endpush

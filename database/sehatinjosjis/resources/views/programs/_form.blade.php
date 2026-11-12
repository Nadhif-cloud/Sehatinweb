@csrf
<div class="space-y-5">
    <div>
        <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Program</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $program->nama ?? '') }}" maxlength="255" required
               class="w-full rounded-xl border px-4 py-2.5 text-sm outline-none focus:border-[#007789] focus:ring-2 focus:ring-teal-100 {{ $errors->has('nama') ? 'border-red-400' : 'border-slate-200' }}">
        @error('nama')<p class="mt-1.5 text-xs text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" maxlength="5000" required
                  class="w-full rounded-xl border px-4 py-2.5 text-sm outline-none focus:border-[#007789] focus:ring-2 focus:ring-teal-100 {{ $errors->has('deskripsi') ? 'border-red-400' : 'border-slate-200' }}">{{ old('deskripsi', $program->deskripsi ?? '') }}</textarea>
        @error('deskripsi')<p class="mt-1.5 text-xs text-red-600" role="alert">{{ $message }}</p>@enderror
    </div>
    <div class="flex items-center gap-3">
        <button type="submit" class="rounded-full bg-[#007789] px-6 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-[#005a69]">{{ $submit }}</button>
        <a href="{{ route('programs.index') }}" class="rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-600 transition-colors hover:bg-slate-50">Batal</a>
    </div>
</div>

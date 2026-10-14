<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Kode Skema</label>
        <input type="text" name="kode_skema" value="{{ old('kode_skema', $skema->kode_skema ?? '') }}"
            class="form-control @error('kode_skema') is-invalid @enderror">
        @error('kode_skema')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-8">
        <label class="form-label">Nama Skema</label>
        <input type="text" name="nama_skema" value="{{ old('nama_skema', $skema->nama_skema ?? '') }}"
            class="form-control @error('nama_skema') is-invalid @enderror">
        @error('nama_skema')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $skema->deskripsi ?? '') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('skema.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</div>

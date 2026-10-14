<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">NIK</label>
        <input type="text" name="nik" value="{{ old('nik', $peserta->nik ?? '') }}"
            class="form-control @error('nik') is-invalid @enderror">
        @error('nik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" value="{{ old('nama', $peserta->nama ?? '') }}"
            class="form-control @error('nama') is-invalid @enderror">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="text" name="email" value="{{ old('email', $peserta->email ?? '') }}"
            class="form-control @error('email') is-invalid @enderror">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $peserta->no_hp ?? '') }}"
            class="form-control @error('no_hp') is-invalid @enderror">
        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $peserta->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Skema Sertifikasi</label>
        <select name="skema_id" class="form-control form-select @error('skema_id') is-invalid @enderror">
            <option value="">-- Pilih Skema --</option>
            @foreach ($skemas as $skema)
                <option value="{{ $skema->id }}"
                    {{ old('skema_id', $peserta->skema_id ?? '') == $skema->id ? 'selected' : '' }}>
                    {{ $skema->nama_skema }}
                </option>
            @endforeach
        </select>
        @error('skema_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('peserta.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</div>

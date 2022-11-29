<x-layout title="Bimbingan Saya">
    <div class="container py-5">
        <h2 class="fw-semibold">Mahasiswa Bimbingan Saya</h2>
        @if ($dosen != null)
            <div class="row align-items-center justify-content-end py-2">
                <div class="col-2 d-flex justify-content-end">
                    <p class="m-0">Sisa Kuota Bimbingan: <span class="fw-semibold">
                            {{ $dosen->kuota - $bimbingans->count() }}/{{ $dosen->kuota }}
                        </span>
                    </p>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                        Kuota</button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                <p class="fw-semibold m-0">Berhasil mengajukan penambahan kuota bimbingan!</p>
                <p class="m-0">Pengajuan dapat dilihat pada halaman Pengajuan Saya.</p>
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Topik Skripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bimbingans as $bimbingan)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $bimbingan->nama }}</td>
                        <td>{{ $bimbingan->nim }}</td>
                        <td>{{ $bimbingan->topik_skripsi }}</td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4" class="poppins fw-semibold">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajukan Penambahan Kuota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store_pengajuan') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kuota_diajukan" class="col-form-label">Jumlah Kuota Diminta (maks. 5):</label>
                            <input type="text" class="form-control" id="kuota_diajukan" name="kuota_diajukan">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                        <input type="text" value="0" hidden disabled>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="successModalLabel">Berhasil mengajukan penambahan kuota!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pengajuan dapat dilihat pada halaman Pengajuan Saya</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


</x-layout>

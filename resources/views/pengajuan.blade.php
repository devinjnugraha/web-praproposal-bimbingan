<x-layout title="Pengajuan Saya">
    <div class="container py-5">
        <h2 class="fw-semibold mb-4">Pengajuan Saya</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Pengajuan</th>
                    <th scope="col">Jumlah Kuota Diajukan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuans as $pengajuan)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $pengajuan->id }}</td>
                        <td>{{ $pengajuan->kuota_diajukan }}</td>
                        <td>{{ $pengajuan->keterangan }}</td>
                        <td>{{ $pengajuan->created_at }}</td>
                        @if ($pengajuan->status === null)
                            <td class="text-warning fw-semibold">
                                Diproses
                                <span>
                                    <a data-bs-toggle="modal" data-bs-target="#diprosesModal"
                                        class="fw-light text-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                </span>
                            </td>
                        @elseif ($pengajuan->status === 1)
                            <td class="text-success fw-semibold">
                                Diterima
                                <span>
                                    <a data-bs-toggle="modal" data-bs-target="#diterimaModal"
                                        class="fw-light text-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                </span>
                            </td>
                        @elseif ($pengajuan->status === 0)
                            <td class="text-danger fw-semibold">
                                Ditolak
                                <span>
                                    <a data-bs-toggle="modal" data-bs-target="#ditolakModal"
                                        class="fw-light text-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                </span>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="6" class="poppins fw-semibold">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Diproses -->
    <div class="modal fade" id="diprosesModal" tabindex="-1" aria-labelledby="diprosesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="diprosesModalLabel">Detail Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold m-0">Status: </p>
                    <p>Diproses</p>
                    <p class="fw-semibold m-0">Keterangan: </p>
                    <p>Pengajuan sedang diproses.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Diterima -->
    <div class="modal fade" id="diterimaModal" tabindex="-1" aria-labelledby="diterimaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="diterimaModalLabel">Detail Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold m-0">Status: </p>
                    <p>Diterima</p>
                    <p class="fw-semibold m-0">Keterangan: </p>
                    <p>Pengajuan penambahan kuota diterima. Silakan cek kuota bimbingan Anda.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ditolak -->
    <div class="modal fade" id="ditolakModal" tabindex="-1" aria-labelledby="ditolakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ditolakModalLabel">Detail Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-semibold m-0">Status: </p>
                    <p>Ditolak</p>
                    <p class="fw-semibold m-0">Keterangan: </p>
                    <p>Pengajuan penambahan kuota ditolak.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>

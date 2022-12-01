<x-layout title="Admin">
    <div class="container py-5">
        <h2 class="fw-semibold mb-4">Admin Page Pengajuan Penambahan Kuota Bimbingan</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Pengajuan</th>
                    <th scope="col">Dosen Pengaju</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Jumlah Kuota Diajukan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengajuans as $pengajuan)
                    <tr
                        @if ($pengajuan->status !== null) style="background-color: {{ $pengajuan->status === 1 ? '#97fcb2' : '#ff94a9' }}" @endif>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $pengajuan->id }}</td>
                        <td>{{ $dosens->find($pengajuan->dosen_id)->nama }}</td>
                        <td>{{ $dosens->find($pengajuan->dosen_id)->nip }}</td>
                        <td>{{ $pengajuan->kuota_diajukan }}</td>
                        <td>{{ $pengajuan->keterangan }}</td>
                        <td>{{ $pengajuan->created_at }}</td>
                        <td>
                            <form action="{{ route('approval.accept', $pengajuan) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success text-white border-primary">✓</button>
                            </form>
                            <form action="{{ route('approval.reject', $pengajuan) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger text-white border-primary">×</button>
                            </form>
                            <form action="{{ route('approval.cancel', $pengajuan) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary text-white border-primary">?</button>
                            </form>
                        </td>
                    @empty
                    <tr class="text-center">
                        <td colspan="8" class="poppins fw-semibold">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>

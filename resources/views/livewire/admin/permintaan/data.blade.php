<div>
    <div class="d-flex mb-3">
    <a href="{{ route('admin.permintaan.create') }}" class="btn btn-outline-secondary">Tambah</a>
        <div class="d-flex ms-auto">
			<input wire:model='search' type="text" class="form-control" placeholder="Cari...">
			<div class="ms-2" style="width: 100px">
				<select wire:model='pages' class="form-select" aria-label="Default select example">
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="99999999999">All</option>
				</select>
			</div>
		</div>
    </div>
    <div class="table-responsive" wire:loading.remove wire:target='search'>
        <table class="table table-borderless table-striped table-hover mt-3">  <!-- update -->
            <thead class="table-head">  <!-- update -->
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Permintaan</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Pengguna</th>
                    <th scope="col">No Telepon</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Waktu Permintaan</th>
                    <th scope="col">Waktu Update</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $item->uuid }}</td>
                    <td>{{ $item->layanan }}</td>
                    <td>{{ $item->pengguna }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->tujuan_akhir }}</td>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                    @if($item->status == 'BARU')
                        <span class="badge rounded-pill bg-danger px-3">BARU</span>
                    @elseif($item->status == 'DIKONFIRMASI')
                        <span class="badge rounded-pill bg-warning px-3">DIKONFIRMASI</span>
                    @elseif($item->status == 'DALAM PERJALANAN')
                        <span class="badge rounded-pill bg-primary px-3">DALAM PERJALANAN</span>
                    @elseif($item->status == 'SELESAI')
                        <span class="badge rounded-pill bg-success px-3">SELESAI</span>
                    @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.permintaan.edit', ['id' => $item->id_permintaan]) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                        </a>
                        <a href="{{ route('admin.permintaan.detail', ['id' => $item->id_permintaan]) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-eye fa-sm fa-fw"></i>
                        </a>
                        <button wire:click="removed({{ $item->id_permintaan }})" type="button" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-trash fa-sm fa-fw"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border rounded p-5 mb-3" wire:loading.block wire:target='search'>
		<div class="d-flex justify-content-center mb-4">
			<div class="spinner-border" role="status">
			  <span class="visually-hidden">Loading...</span>
			</div>
		</div>
		<p class="fw-bold fs-5 text-center m-0">Loading...</p>
	</div>
    <div class="d-flex align-items-center">
        <p class="mb-0 border py-1 px-2 rounded">
            <span class="fw-bold">{{ $data->count() }}</span>
        </p>
        @if ($data->hasPages())
        <nav class="ms-auto">
            {{ $data->links('admin.layouts.paginations') }}
        </nav>
        @endif
    </div>

<script>
    document.addEventListener('deleteConfirmed', function() {
        Swal.fire({
            title: "Hapus?",
            text: "Apa Kamu yakin menghapus Data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak',
        }).then((next) => {
            if (next.isConfirmed) {
                Livewire.emit('deleteAction');
            } else {
                Swal.fire("Data tetap Aman!");
            }
        });
    });

    window.addEventListener('success', event => {
        Swal.fire({
            icon: 'success',
            title: 'Good Jobs!',
            text: event.detail,
        });
    });

    window.addEventListener('error', event => {
        Swal.fire({
            icon: 'error',
            title: 'Opps...!',
            text: event.detail,
        });
    });
</script>

</div>
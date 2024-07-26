<div>
    <div class="d-flex mb-3">
        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-outline-success"><i class="fas fa-plus-circle fa-sm fa-fw me-1"></i>Tambah</a>
        <div class="d-flex ms-auto">
			<input wire:model='search' type="text" class="form-control" placeholder="Cari...">
			<div class="ms-2" style="width: 100px">
				<select wire:model='pages' class="form-select" aria-label="Default select example">
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="99999999999">all</option>
				</select>
			</div>
		</div>
    </div>
    <div class="table-responsive" wire:loading.remove wire:target='search'>
        <table class="table table-borderless table-striped table-hover mt-3">  <!-- update -->
            <thead class="table-head">  <!-- update -->
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama kendaraan</th>
                    <th scope="col">Nopol</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nopol }}</td>
                    <td>{{ $item->warna }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.kendaraan.edit', ['id' => $item->id]) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-pencil-alt fa-sm fa-fw"></i>
                        </a>
                        <a href="{{ route('admin.kendaraan.detail', ['id' => $item->id]) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-eye fa-sm fa-fw"></i>
                        </a>
                        <button wire:click="removed({{ $item->id }})" type="button"
                            class="btn btn-outline-danger btn-sm">
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
        document.addEventListener('deleteConfrimed', function() {
            Swal.fire({
                    title: "Hapus?",
                    text: "Apa Anda yakin ingin menghapus data kendaraan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Tidak',
                })
                .then((next) => {
                    if (next.isConfirmed) {
                        Livewire.emit('deleteAction');
                    } else {
                        Swal.fire("Data Kendaraan tetap Aman!");
                    }
                });
        })
        window.addEventListener('success', event => {
            Swal.fire({
                icon: 'success',
                title: 'Good Jobs!',
                text: event.detail,
            })
        })
        window.addEventListener('erros', event => {
            Swal.fire({
                icon: 'error',
                title: 'Opps...!',
                text: event.detail,
            })
        })
    </script>

</div>
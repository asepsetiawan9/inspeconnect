@if ($users->isEmpty())
<tr>
    <td class="text-center" colspan="6">Data tidak ditemukan.</td>
</tr>
@else
@foreach ($users as $user)
<tr>
    <td class="align-middle text-sm ">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->username }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->email }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0">{{ $user->phone }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->city }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->desa }}</p>
    </td>
    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('user-management.edit', ['id' => $user->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('user-management.show', ['id' => $user->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-primary rounded text-white">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('user-management.confirm-delete', ['id' => $user->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white" onclick="event.preventDefault(); deleteItem('{{ $user->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $user->id }}" action="{{ route('user-management.delete', ['id' => $user->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </td>
</tr>

@endforeach
@push('js')
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script>
    function deleteItem(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus pengguna ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',

        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endpush
@endif



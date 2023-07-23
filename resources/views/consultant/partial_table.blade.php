@if ($consultants->isEmpty())
<tr>
    <td class="text-center" colspan="6">Data tidak ditemukan.</td>
</tr>
@else
@foreach ($consultants as $consultant)
<tr>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{$consultant->name ? $consultant->name : '-' }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{$consultant->telp ? $consultant->telp : '-'}}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 ">{{$consultant->jabatan}}</p>
    </td>

    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('consultant.edit', ['id' => $consultant->id]) }}" class="text-decoration-none">

                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('consultant.show', ['id' => $consultant->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-primary rounded text-white">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('consultant.confirm-delete', ['id' => $consultant->id]) }}"
                class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white"
                    onclick="event.preventDefault(); deleteItem('{{ $consultant->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $consultant->id }}"
                action="{{ route('consultant.delete', ['id' => $consultant->id]) }}" method="POST"
                style="display: none;">
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
            text: 'Anda yakin ingin menghapus data ini?',
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

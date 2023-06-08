@foreach ($povertys as $poverty)
<tr>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">{{ $poverty->nama }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $poverty->nik }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 ">{{ $poverty->kk }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{ $poverty->kecamatan ? $poverty->kecamatan->name : '' }}
        </p>
    </td>
    <td class="align-middle text-sm">
        @if ($poverty->status_bantuan === 2)
        <p class="text-sm font-weight-bold mb-0 text-capitalize text-center rounded px-2 py-1 bg-success">Sudah Mendapatkan</p>
        @else
        <p class="text-sm font-weight-bold mb-0 text-capitalize text-center text-white rounded px-2 py-1 bg-danger">Belum Mendapatkan</p>
        @endif
    </td>

    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">{{ $poverty->desil }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">{{ $poverty->tahun_input }}</p>
    </td>
    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('poverty.edit', ['id' => $poverty->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('poverty.show', ['id' => $poverty->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-primary rounded text-white">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('poverty.confirm-delete', ['id' => $poverty->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white"
                    onclick="event.preventDefault(); deleteItem('{{ $poverty->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $poverty->id }}" action="{{ route('poverty.delete', ['id' => $poverty->id]) }}"
                method="POST" style="display: none;">
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

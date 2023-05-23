@if ($populations->isEmpty())
<tr>
    <td class="text-center" colspan="6">Data tidak ditemukan.</td>
</tr>
@else
@foreach ($populations as $population)
<tr>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{ number_format($population->jumlah_penduduk, 0, ',', '.') }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{ number_format($population->jumlah_kk, 0, ',', '.') }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 ">{{ number_format($population->jumlah_laki_laki, 0, ',', '.') }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{ number_format($population->jumlah_perempuan, 0, ',', '.') }}</p>
    </td>

    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">{{ $population->tahun }}</p>
    </td>
    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('population-data.edit', ['id' => $population->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('population-data.confirm-delete', ['id' => $population->id]) }}"
                class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white"
                    onclick="event.preventDefault(); deleteItem('{{ $population->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $population->id }}"
                action="{{ route('population-data.delete', ['id' => $population->id]) }}" method="POST"
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

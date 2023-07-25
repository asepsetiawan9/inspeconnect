@if ($reports->isEmpty())
<tr>
    <td class="text-center" colspan="6">Data tidak ditemukan.</td>
</tr>
@else
@foreach ($reports as $report)
<tr>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{$report->user->name ? $report->user->name : '-' }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{$report->name ? $report->name : '-' }}</p>
    </td>
    
    <td class="align-middle text-sm">
        @php
        $statusLabel = '-';
        $statusClass = 'btn-secondary';
        switch ($report->status) {
            case 1:
                $statusLabel = 'Selesai';
                $statusClass = 'btn-success';
                break;
            case 2:
                $statusLabel = 'Belum Dilihat';
                $statusClass = 'btn-warning';
                break;
            case 3:
                $statusLabel = 'Diproses';
                $statusClass = 'btn-primary';
                break;
            default:
                // Do nothing
        }
    @endphp
    <button class="btn {{ $statusClass }} text-capitalize" disabled>{{ $statusLabel }}</button>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{$report->created_at ? $report->created_at : '-'}}</p>
    </td>
    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('report.edit', ['id' => $report->id]) }}" class="text-decoration-none">

                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('report.show', ['id' => $report->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-primary rounded text-white">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('report.confirm-delete', ['id' => $report->id]) }}"
                class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white"
                    onclick="event.preventDefault(); deleteItem('{{ $report->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $report->id }}"
                action="{{ route('report.delete', ['id' => $report->id]) }}" method="POST"
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

@if ($schedules->isEmpty())
<tr>
    <td class="text-center" colspan="6">Data tidak ditemukan.</td>
</tr>
@else
@foreach ($schedules as $schedule)
<tr>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{$schedule->skpd->name ? $schedule->skpd->name : '-' }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize ">
            {{$schedule->consultant->name ? $schedule->consultant->name : '-' }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{$schedule->date ? $schedule->date : '-'}}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{$schedule->time ? $schedule->time : '-'}}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">
            {{$schedule->place ? $schedule->place : '-'}}</p>
    </td>
    @if (!function_exists('getStatusText'))
    @php
        function getStatusText($status) {
            switch ($status) {
                case 1:
                    return 'Perlu Ditanggapi';
                case 2:
                    return 'Selesai';
                case 3:
                    return 'Akan Dihadiri';
                case 4:
                    return 'Dijadwalkan Ulang';
                default:
                    return 'Status Tidak Dikenali';
            }
        }
    @endphp
@endif

<td class="align-middle text-sm">
    @php
        $statusClass = '';
        switch ($schedule->status) {
            case 1:
                $statusClass = 'btn-primary';
                break;
            case 2:
                $statusClass = 'btn-success';
                break;
            case 3:
                $statusClass = 'btn-info';
                break;
            case 4:
                $statusClass = 'btn-warning';
                break;
            default:
                $statusClass = 'btn-secondary';
        }
    @endphp
    <p class="text-sm font-weight-bold mb-0 text-capitalize">
        <span class="btn {{ $statusClass }}">{{ getStatusText($schedule->status) }}</span>
    </p>
</td>



    <td class="align-middle text-left">
        <div class="d-flex justify-content-center align-items-center gap-1 action-buttons">
            <a href="{{ route('schedule.edit', ['id' => $schedule->id]) }}" class="text-decoration-none">

                <div class="px-2 py-1 bg-warning rounded">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('schedule.show', ['id' => $schedule->id]) }}" class="text-decoration-none">
                <div class="px-2 py-1 bg-primary rounded text-white">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
            </a>

            <a href="{{ route('schedule.confirm-delete', ['id' => $schedule->id]) }}"
                class="text-decoration-none">
                <div class="px-2 py-1 bg-danger rounded text-white"
                    onclick="event.preventDefault(); deleteItem('{{ $schedule->id }}')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
            </a>

            <form id="delete-form-{{ $schedule->id }}"
                action="{{ route('schedule.delete', ['id' => $schedule->id]) }}" method="POST"
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

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
            <div class="px-2 py-1 bg-warning rounded ">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </div>
            <div class="px-2 py-1 bg-primary rounded text-white ">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </div>
            <div class="px-2 py-1 bg-danger rounded text-white ">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </div>
        </div>
    </td>
</tr>

@endforeach
@endif

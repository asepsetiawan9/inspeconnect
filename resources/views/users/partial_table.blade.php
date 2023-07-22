@foreach ($users as $user)
<tr>
    <td class="align-middle text-sm ">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->name }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->email }}</p>
    </td>
    <td class="align-middle text-sm">
        <p class="text-sm font-weight-bold mb-0 text-capitalize">{{ $user->role }}</p>
    </td>
    <td class="align-middle text-sm">
        @if($user->status === 0 || $user->status === null)
            <p class="text-sm font-weight-bold mb-0 text-capitalize bg-primary text-center rounded">
                <a href="#" onclick="updateStatus({{ $user->id }})">
                    Belum Di verifikasi
                </a>
            </p>
        @else
            <p class="text-sm font-weight-bold mb-0 text-capitalize bg-success text-center rounded">        
                <a href="#" onclick="updateStatus({{ $user->id }})">
                    Terverifikasi
                </a>
            </p>
        @endif
        
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


<script>
    function updateStatus(userId) {
        // Tampilkan SweetAlert dengan opsi konfirmasi
        Swal.fire({
            title: 'Ubah Status',
            text: 'Anda yakin ingin mengubah status?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan ke server untuk mengubah status menggunakan AJAX
                $.ajax({
                    url: `/users/${userId}/update-status`,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                         Swal.fire({
                            title: 'Berhasil',
                            text: 'Status berhasil diubah!',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        // Reload halaman setelah SweetAlert ditutup
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengubah status!',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>

@endpush



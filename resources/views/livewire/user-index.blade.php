<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header h4">Detail Pengguna</div>
    
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg> Tambah Pengguna
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Password</th>
                                            <th>Outlet</th>
                                            <th><i>Role</i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-success">Reset Password</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header h3">
                        Mitra Kredit
                    </div>
                
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                
                    @if ($showUpdate)
                        <livewire:credit-partner-update />
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-success btn-sm" wire:click='cancelUpdate()'>Batal Ubah</button>
                                </div>
                            </div>                            
                        </div>
                    @else
                        <livewire:credit-partner-create />
                    @endif
                
                    <div class="card-body">
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Mitra</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                @if ($data->isNotEmpty())
                                    @foreach ($data as $d)
                                        <tr>
                                            <td class="text-center">{{ $d->nama_mitra }}</td>
                                            <td class="text-center">{{ $d->alamat }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success" wire:click='updateCreditPartner({{ $d->id }})'>ubah</button>
                                                <button class="btn btn-sm btn-danger">hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <i>Mitra Belum Diinput</i>
                                        </td>
                                    </tr>
                                @endif
                                
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
    })
</script>


<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header h3">
                        Pengajuan Kredit
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
                        <livewire:credit-customer-update />
                    @elseif ($showCreate)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-success btn-sm" wire:click="cancelCreate()">Batal Tambah Data</button>
                                </div>
                            </div>
                        </div>
                        <livewire:credit-customer-create />
                    @else
                        <div class="card-body mb-n2">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary" wire:click="showCreate()">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                    
                
                    <div class="card-body">
                        
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Pelanggan Kredit</th>
                                    <th class="text-center">No KTP (NIK)</th>
                                    <th class="text-center">No KK</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">No HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                            </tbody>
                        </table>
                        
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
    })
</script>

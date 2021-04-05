<div>
    <div class="container-fluid">
        @if ($showCreate)
            <livewire:credit-invoice-create :partnerId="$partnerId"/>
        @elseif ($showUpdate)
            <livewire:credit-invoice-update :partnerId="$partnerId"/>
        @else
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header h3">
                            Pengambilan Kredit (Belum Diklaim)
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary" wire:click="showCreate()">Tambah Data</button>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Konsumen</th>
                                                <th>No HP</th>
                                                <th>Kode/Imei HP</th>
                                                <th>Tipe HP</th>
                                                <th>Harga</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Outlet</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->nama }}</td>
                                                    <td>{{ $invoice->no_hp }}</td>
                                                    <td>{{ Product::show($invoice->product_id)->kode }}</td>
                                                    <td>{{ Product::show($invoice->product_id)->tipe }}</td>
                                                    <td>Rp. {{ number_format(Product::show($invoice->product_id)->jual,0,",",".") }}</td>
                                                    <td>{{ $invoice->email ? $invoice->email : '-' }}</td>
                                                    <td>{{ $invoice->password ? $invoice->password : '-' }}</td>
                                                    <td class="text-danger">Belum Diklaim</td>
                                                    <td>{{ Outlet::getOutlet($invoice->outlet_id)->nama }}</td>
                                                    <td>
                                                        <div x-data="{ hapus: false, general: true }">
                                                            <div x-show='general'>                                                                  
                                                                @role('SUPER ADMIN')
                                                                    <button class="btn btn-sm btn-danger" @click="hapus=true;general=false">hapus</button>
                                                                @endrole
        
                                                                @role('ADMIN|FRONT LINER')
                                                                    @if (User::getOutletUser(Auth::user()->id)->outlet_id == $invoice->outlet_id)
                                                                        <button class="btn btn-sm btn-success" wire:click='showUpdate({{ $invoice->id }})'>ubah</button>
                                                                        <button class="btn btn-sm btn-danger" @click="hapus=true;general=false">hapus</button>
                                                                    @endif
                                                                @endrole
                                                            </div>
                                                            
                                                            @role('ADMIN|SUPER ADMIN')
                                                            <div x-show="hapus" @click.away="hapus=false">
                                                                Apakah Anda Yakin?
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <button class="btn btn-sm btn-secondary" @click="hapus=false;general=true">Tidak</button>
                                                                        <button class="btn btn-sm btn-danger" @click="hapus=false;general=true" wire:click="delete({{ $invoice->id }})">Ya</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endrole
                                                        </div>
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
        @endif

        
    </div>
    
</div>

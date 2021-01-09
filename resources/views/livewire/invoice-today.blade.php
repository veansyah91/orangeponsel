<div>
    <div class="card">

        <div class="card-header h3">
            Detail Harian
        </div>
    
        <div class="card-body">
            <input 
                type="date" 
                class="form-control"
                wire:model="tanggal"
            >
        </div>

        <div class="card-body">
            <table class="table table-sm table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Nota</th>
                        <th class="text-center">Pelanggan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Jam</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $d->no_nota }}</td>
                            <td class="text-center">{{ $d->customer->nama }}</td>
                            <td class="text-center">Rp. {{ number_format(Invoice::getTotal($d->id),0,",",".") }}</td>
                            <td class="text-center">{{ substr($d->updated_at,11)  }}</td>
                        </tr>
                        @php
                            $total += Invoice::getTotal($d->id);
                        @endphp
                    @endforeach
                    <tr class="font-weight-bold">
                        <td colspan="2">Total</td>
                        <td colspan="2" class="text-right">Rp. {{ number_format($total,0,",",".") }}</td>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
    
        
    </div>
</div>

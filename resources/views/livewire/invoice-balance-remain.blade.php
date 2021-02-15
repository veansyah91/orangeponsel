<div>    
    <div class="row">
        <div class="col">
            <h2 class="font-weight-bold">SISA SALDO</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table>
                <tbody>
                    @foreach ($servers as $server)
                    <tr>
                        <td>
                            <h4>{{ $server->nama }}</h4>  
                        </td>
                        <td>
                            <h4>
                                
                                : Rp. {{ number_format(Invoice::getBalanceBalance($outletId, $server->supplier_id),0,",",".") }}
                            </h4>   
                        </td>
                    </tr>    
                    @endforeach                
                </tbody>
            </table>
        </div>        
    </div>
</div>

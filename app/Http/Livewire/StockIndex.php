<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination; 

use Illuminate\Support\Facades\DB;
use App\Model\Stock;

class StockIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 5;
    public $search = '';

    public $showUpdate;
    public $stocks;

    protected $listeners = [
        "stockStored" => "handleStore",
        "stockUpdated" => "handleUpdate",
        "cancelUpdateStock" => "handleCancelUpdate"
    ];

    public function render()
    {
        $stocks =  $this->search == '' ? DB::table('stocks')->join('outlets','outlets.id','=','stocks.outlet_id')
                                                    ->join('products','products.id','=','stocks.product_id')                                                    
                                                    ->select('stocks.id','stocks.updated_at','stocks.jumlah','outlets.nama as nama_outlet','products.tipe', 'products.kode','products.category_id')
                                                    ->orderByDesc('jumlah')
                                                    ->paginate($this->paginate) 
                                         :
                                         DB::table('stocks')->join('outlets','outlets.id','=','stocks.outlet_id')
                                                    ->join('products','products.id','=','stocks.product_id')
                                                    ->where('products.tipe','like', '%' . $this->search . '%')
                                                    ->orWhere('products.kode','like', '%' . $this->search . '%')
                                                    ->select('stocks.id','stocks.updated_at','stocks.jumlah','outlets.nama as nama_outlet','products.tipe', 'products.kode','products.category_id')
                                                    ->orderByDesc('jumlah')
                                                    ->paginate($this->paginate)  ;


        return view('livewire.stock-index',[
            'data' => $stocks
        ]);
    }

    public function handleStore()
    {
        session()->flash('success', "Stok Berhasil Ditambah");
    }

    public function handleUpdate()
    {
        $this->showUpdate = false;
        session()->flash('success', "Stok Berhasil Diubah");
    }

    public function handleCancelUpdate(){
        // dd();
        $this->showUpdate = false;
    }

    public function destroy($id)
    {
        if ($id) {
            $stock = Stock::find($id);
            $stock->delete();
            session()->flash('success', "Stok Berhasil Dihapus");
        }
    }

    public function getOutlet($id)
    {
        $this->showUpdate = true;
        $stock = Stock::find($id);
        $this->emit('getStock', $stock);
    }
}

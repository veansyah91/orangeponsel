<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Model\Product;
use App\Model\Outlet;
use App\Model\Stock;

class StockCreate extends Component
{
    public $showProductInputList;
    public $productInputLists;
    public $product;
    public $productId;

    public $outletId;
    public $outlets;
    public $kode;
    public $tipe;

    public $jumlah;

    public function mount(){

        $this->resetListInput();
        
    }

    public function render()
    {
        $this->productInputLists = Product::where('kode', 'like', '%' . $this->kode . '%')->skip(0)->take(5)->get();
        return view('livewire.stock-create',[
            'outlets' => $this->outlets,
            'productInputLists' => $this->productInputLists
        ]);
    }

    public function showSearchProduct()
    {
        $this->showProductInputList ? $this->showProductInputList = false : $this->showProductInputList = true;
    }

    public function inputSearchProduct()
    {
        $this->showProductInputList = true;
    }

    public function resetListInput()
    {
        $this->showProductInputList = false;
        $this->jumlah = 1;
        $this->outlets = Outlet::all();
        $this->outletId = $this->outlets[0]->id;
        $this->tipe = '';
        $this->kode = '';
    }

    public function selectProduct($id,$kode, $tipe)
    {
        $this->kode = $kode;
        $this->tipe = $tipe;
        $this->productId = $id;
        $this->showProductInputList = false;

    }

    public function store()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->validate([
            'kode' => 'required',
        ]);

        // Cek Apakah Sudah Pernah Diinputkan Stoknya
        $stock = Stock::where('product_id', $this->productId)->first();

        if ($stock) {
            $updateStock = Stock::where('id', $stock->id)->update([
                'jumlah' => $stock->jumlah + $this->jumlah,
                'updated_at' => Date('Y-m-d H:i:s')
            ]);
        } else {
            $newStock = Stock::create([
                'product_id' => $this->productId,
                'outlet_id' => $this->outletId,
                'jumlah' => $this->jumlah,
                'created_at' => Date('Y-m-d H:i:s')
            ]);
        }

        $this->resetListInput();

        $this->emit('stockStored');
        
    }
    
}

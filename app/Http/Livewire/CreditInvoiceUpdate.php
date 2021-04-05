<?php

namespace App\Http\Livewire;

use App\Model\Stock;
use App\Model\Product;
use Livewire\Component;
use App\Model\OutletUser;
use App\Helpers\RoleHelper;
use App\Model\CreditInvoice;
use App\Model\CreditApplication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreditInvoiceUpdate extends Component
{
    public $partnerId;

    public $outlet;
    
    public $creditCustomerName, $creditCustomerId, $search ,$showNameSearch;

    public $searchType, $showTypeSearch, $type, $productId, $stockId, $jumlahUnit, $tanggal, $password, $email, $productIdLama;

    public $harga, $invoiceId;

    public $applicationId;

    protected $listeners = [
        'updateData' => 'handleUpdateData'
    ];

    public function mount($partnerId)
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tanggal = Date('Y-m-d');

        $user = Auth::user();
        $roleUser = RoleHelper::getRole($user->id);

        $this->partnerId = $partnerId;

        $outletUser = OutletUser::where('user_id', $user->id)->first();

        $this->outlet = $outletUser->outlet_id;

        $this->showNameSearch = false;

        $this->showTypeSearch = false;
        
        $this->search = '';
        $this->searchType = '';
    }

    public function render()
    {
        $creditCustomers = DB::table('credit_applications')
                                ->join('credit_customers','credit_customers.id','=','credit_applications.credit_customer_id')
                                ->where('credit_customers.outlet_id', $this->outlet)                 
                                ->where('credit_applications.credit_partner_id', $this->partnerId)    
                                ->where('credit_applications.status', '=', 1)         
                                ->where(function($query) {
                                    $query->where('credit_customers.nama', 'like', '%' . $this->search . '%')
                                          ->orWhere('credit_customers.no_hp', 'like', '%' . $this->search . '%');
                                })       
                                ->select('credit_applications.id as id','credit_applications.credit_customer_id','credit_customers.nama','credit_customers.no_hp')     
                                ->skip(0)
                                ->take(5)
                                ->get();

        $products = DB::table('stocks')
                        ->join('products','products.id','=','stocks.product_id')
                        ->where('stocks.outlet_id', $this->outlet)
                        ->where('products.kode', 'like', '%' . $this->searchType . '%')
                        ->where('stocks.jumlah','>', 0)
                        ->select('stocks.id','products.kode','products.tipe')
                        ->skip(0)
                        ->take(5)
                        ->get();
        
        return view('livewire.credit-invoice-update',[
            'creditCustomers' => $creditCustomers,
            'products' => $products
        ]);
    }

    public function handleUpdateData($id)
    {
        // cari isi nota credit
        $creditInvoice = CreditInvoice::find($id);
        $this->invoiceId = $creditInvoice->id;

        // cari product
        $product = Product::find($creditInvoice->product_id);

        $this->type = $product->tipe;
        $this->productId = $creditInvoice->product_id;
        $this->productIdLama = $creditInvoice->product_id;
        $this->harga = $creditInvoice->harga;
        $this->email = $creditInvoice->email;
        $this->password = $creditInvoice->password;

        // cari Customer
        $creditApplication = CreditApplication::find($creditInvoice->credit_application_id);

        // tampilkan nama konsumen 
        $this->creditCustomerName = $creditApplication->creditCustomer->nama;

        // simpan applicationId
        $this->applicationId = $creditApplication->id;


    }

    public function cancelUpdate()
    {
        $this->emit('cancelUpdate');
    }
    
    public function update()
    {
        
        $this->validate([
            'creditCustomerName' => 'required',
            'type' => 'required',
        ]);

        $update = CreditInvoice::find($this->invoiceId)->update([
            'credit_application_id' =>  $this->applicationId,
            'harga' =>  $this->harga,
            'product_id' =>  $this->productId,
            'created_at' =>  $this->tanggal,
        ]);

        // ubah status pengajuan
        $update = CreditApplication::find($this->applicationId)->update([
            'status' => 3,
            'email' => $this->email,
            'password' => $this->password,
        ]);


        // kembalikan stock lama
        $stock = Stock::where('product_id', $this->productIdLama)->first();
        
        $jumlahStock = $stock->jumlah + 1;

        $stock->update([
            'jumlah' => $jumlahStock
        ]);

        // kurangi jumlah stock
        $this->jumlahUnit--;        
        $updateStock = Stock::find($this->stockId)->update([
            'jumlah' => $this->jumlahUnit
        ]);

        $this->emit('successUpdate');

    }

    public function showNameSearch()
    {
        $this->showNameSearch = !$this->showNameSearch;
    }

    public function selectCustomer($id, $customerName)
    {
        $this->showNameSearch = !$this->showNameSearch;
        $this->creditCustomerName = $customerName;
        $this->applicationId = $id;
    }

    public function showTypeSearch()
    {
        $this->showTypeSearch = !$this->showTypeSearch;
    }

    public function selectType($id)
    {
        $stock = Stock::find($id);

        $this->showTypeSearch = !$this->showTypeSearch;

        $this->stockId = $id;

        $this->type = $stock->product->tipe;
        $this->harga = $stock->product->jual;
        $this->jumlahUnit = $stock->jumlah;
        $this->productId = $stock->product_id;
    }
}

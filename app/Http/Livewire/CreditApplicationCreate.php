<?php

namespace App\Http\Livewire;

use App\Model\Product;
use Livewire\Component;
use App\Model\OutletUser;
use App\Helpers\RoleHelper;
use App\Model\CreditCustomer;
use App\Model\CreditApplication;
use Illuminate\Support\Facades\Auth;

class CreditApplicationCreate extends Component
{
    public $creditCustomerName, $creditCustomerId, $searchName, $showNameSearch, $merk, $searchType, $showTypeSearch, $tenor, $angsuran, $dp, $status, $email, $password, $outlet, $partnerId;

    public function mount($partnerId)
    {
        $user = Auth::user();
        $roleUser = RoleHelper::getRole($user->id);

        $this->partnerId = $partnerId;

        $outletUser = OutletUser::where('user_id', $user->id)->first();

        $this->outlet = $outletUser ? $outletUser->outlet_id : '';

        $this->creditCustomerId = 0;
        $this->creditCustomerName = '';
        $this->searchName = '';
        $this->showNameSearch = false;

        $this->merk = '';
        $this->searchType = '';
        $this->showTypeSearch = false;
        
        $this->tenor = 3;
        $this->angsuran = 0;
        $this->dp = 0;
        $this->status = 0;

    }

    public function render()
    {
        $creditCustomers = $this->outlet ? CreditCustomer::where('outlet_id', $this->outlet)                                            
                                            ->where('no_ktp', 'like', '%' . $this->searchName . '%')
                                            ->skip(0)
                                            ->take(5)
                                            ->get() : 
                                            CreditCustomer::where('no_ktp', 'like', '%' . $this->searchName . '%')
                                            ->skip(0)
                                            ->take(5)
                                            ->get()
                                            ;

        $products = Product::where('tipe', 'like', '%' . $this->searchType . '%') 
                            ->select('tipe')
                            ->distinct()
                            ->get();

        return view('livewire.credit-application-create', [
            'creditCustomers' => $creditCustomers,
            'products' => $products
        ]);
    }

    public function selectCustomer($id ,$name)
    {
        $this->creditCustomerName = $name;
        $this->creditCustomerId = $id;
        $this->showNameSearch = !$this->showNameSearch;
    }

    public function showNameSearch()
    {
        $this->showNameSearch = !$this->showNameSearch;
    }

    public function showTypeSearch()
    {
        $this->showTypeSearch = !$this->showTypeSearch;
    }

    public function selectProduct($name)
    {
        $this->merk = $name;
        $this->showTypeSearch = !$this->showTypeSearch;
    }

    public function store()
    {
        $this->validate([
            'creditCustomerName' => 'required',
            'merk' => 'required',
        ]);

        $store = CreditApplication::create([
            'credit_customer_id' => $this->creditCustomerId,
            'merk' => $this->merk,
            'tenor' => $this->tenor,
            'dp' => $this->dp,
            'angsuran' => $this->angsuran,
            'status' => $this->status,
            'credit_partner_id' => $this->partnerId
        ]);

        $this->emit('hasStored');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;


use App\Model\Outlet;

class InteroutletIndex extends Component
{

    public $outletId, $outlets, $outlet, $selectOutlet, $defaultOtherOutletId, $showModal;

    public function mount(){
        $this->outlets = Outlet::all();

        $this->outletId = $this->outlets[0]->id;
        $this->selectOutlet = $this->outlets[0]->id;
        
        $otherOutlet = Outlet::where('id', '<>', $this->selectOutlet)->get();
        $this->defaultOtherOutletId = $otherOutlet[0]->id;
        
    }

    public function render()
    {
        $otherOutlet = Outlet::where('id', '<>', $this->selectOutlet)->get();
        return view('livewire.interoutlet-index',[
            'otherOutlet' => $otherOutlet,
        ]);
    }

    public function showOutletDetail($outletId)
    {
        
        $this->defaultOtherOutletId = $outletId;
        $this->emit('getOutlet', $this->selectOutlet, $outletId);
    }

    public function changeOutlet()
    {
        $otherOutlet = Outlet::where('id', '<>', $this->selectOutlet)->get();
        
        $this->showOutletDetail($otherOutlet[0]->id);
    }
}

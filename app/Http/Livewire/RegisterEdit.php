<?php

namespace App\Http\Livewire;

use App\User;
use App\Model\Outlet;
use Livewire\Component;
use App\Model\OutletUser;
use App\Helpers\RoleHelper;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class RegisterEdit extends Component
{
    public $name, $email, $password, $outlet, $role, $roleUser, $user, $userId, $outletUser;

    protected $listeners = [
        'editUser' => 'showUser'
    ];

    public function render()
    {
        $user = Auth::user();
        $roleUser = RoleHelper::getRole($user->id);

        $roles = $roleUser->name == "SUPER ADMIN" ? 
                    Role::all() : 
                    Role::where('name', '<>', 'SUPER ADMIN')->get();
        
        $outlets = Outlet::all();
        return view('livewire.register-edit',[
            'outlets' => $outlets,
            'roles' => $roles
        ]);
    }

    public function cancelRegisterUser()
    {
        $this->emit('cancelRegister');
    }

    public function showUser($userId)
    {
        $user = User::find($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        $outletUser = OutletUser::where('user_id', $user->id)->first();
        $this->outlet = $outletUser->outlet_id;

        $this->role = RoleHelper::getRole($user->id)->name;
    }

    public function update()
    {
        $updateUser = User::find($this->userId)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $user = User::find($this->userId);

        // bandingkan role lama dan role input 
        $roleLama = RoleHelper::getRole($user->id)->name;

        if ($roleLama != $this->role){
            // hapus role lama 
            $user->removeRole($roleLama);

            // masukkan role baru 
            $user->assignRole($this->role);
        }
                            
        $role = $user->assignRole($this->role);

        if ($this->role != 'SUPER ADMIN') {
            $outletUser = OutletUser::where('user_id', $user->id)->update([
                'outlet_id' => $this->outlet
            ]);
        } 

        $this->emit('cancelRegister');
    }
}

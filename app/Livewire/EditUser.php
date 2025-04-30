<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public User $user;
    public $open = false;
    public $userEditId = '';
    public $userEdit=['name'=>'',
                        'email' => ''];

    public function mount(User $user) {
        $this->user = $user;
    }
    public function edit($userId) {
        $this->userEditId = $userId;
        $this->open=true;
        $user = User::find($userId);
        $this->userEdit['name'] = $user->name;
        $this->userEdit['email'] = $user->email;
    }
    public function update() {
        $user = User::find($this->userEditId);
        $user->update([
            'name'=> $this->userEdit['name'],
            'email'=> $this->userEdit['email']
        ]);
        $this->reset(['userEdit', 'userEditId','open']);
        $this->dispatch('user-updated'); 

        $this->dispatch('alert-created'); 
    }
    public function render()
    {
        return view('livewire.edit-user');
    }
    
}

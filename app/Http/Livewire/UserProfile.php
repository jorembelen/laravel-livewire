<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class UserProfile extends Component
{
    public $userId, $name, $email, $password;
    public $prevName, $prevEmail;

    public $current_password_for_email;
    public $current_password_for_password;
    public $current_hashed_password;
    public $password_confirmation;

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $model = User::find($this->userId);
        $this->name = $model->name;
        $this->email = $model->email;

        $this->prevName = $model->name;
        $this->prevEmail = $model->email;
        $this->current_hashed_password = $model->password;

    }

    public function hydrate()
    {
        $validateData = [
            'email' => 'email'
        ];

        // This will only validate if there's any changes in the field
        if($this->name !== $this->prevName){
            if(empty($this->name)) {
                $validateData = array_merge($validateData, [
                    'name' => 'required'
                ]);
            }
        }
        
        if($this->email !== $this->prevEmail){
            if(empty($this->email)) {
                $validateData = array_merge($validateData, [
                    'email' => 'required|email'
                ]);
            }

            $validateData = array_merge($validateData, [
                'current_password_for_email' => ['required', 'customPassCheckHashed:' .$this->current_hashed_password]
            ]);

        }

        if(!empty($this->password)){
            $validateData = array_merge($validateData, [
                'current_password_for_password' => ['required', 'customPassCheckHashed:' .$this->current_hashed_password],
                'password' => 'confirmed|min:6',
                'password_confirmation' => 'required'
            ]);
        }

        $this->validate($validateData);
    }

    public function save()
    {
        $data = [];

        // Check if there's any changes from the field
        if($this->name !== $this->prevName){
            $data = array_merge($data, ['name' => $this->name]);
        }
        if($this->email !== $this->prevEmail){
            $data = array_merge($data, ['email' => $this->email]);
        }

        if(!empty($this->password)) {
            $data = array_merge($data, ['password' => Hash::make($this->password)]);
        }

        // $data = array_merge([
        //     'name' => $this->name,
        //     'email' => $this->email
        // ]);

        if(count($data)){
            User::find($this->userId)->update($data);
            return redirect()->to('/profile');
        }
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

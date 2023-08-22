<?php

namespace App\Http\Livewire\Pages;

use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ];

    public function createUser()
    {
        $this->validate();
        $request = new Request([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);
        app(UserController::class)->store($request);
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
    public function render()
    {
        return view('livewire.pages.create-user');
    }
}
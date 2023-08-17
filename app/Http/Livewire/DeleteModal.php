<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DeleteModal extends Component
{
    public $isOpen = false;
    public $itemId;

    public function openModal($id)
    {
        $this->isOpen = true;
        $this->itemId = $id;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }
}

<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UpdateBankDetailsForm extends Component
{
    public $bank_name;
    public $branch_name;
    public $account_holder_name;
    public $account_number;
    public $ifsc_code;

    public function save()
    {
        $this->validate([
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:30',
            'ifsc_code' => 'required|string|max:11',
        ]);

        auth()->user()->bankAccounts()->create([
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'account_holder_name' => $this->account_holder_name,
            'account_number' => $this->account_number,
            'ifsc_code' => $this->ifsc_code,
        ]);

        $this->reset();
        session()->flash('message', 'Bank account added successfully.');
    }
    public function render()
    {
        return view('livewire.profile.update-bank-details-form');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\WithdrawalRequest;
use Livewire\Component;

class WithdrawalRequests extends Component
{
    public function approve($id)
{
    $req = WithdrawalRequest::findOrFail($id);
    $req->update(['status' => 'approved']);
    session()->flash('message', 'Withdrawal approved.');
}

public function reject($id)
{
    $req = WithdrawalRequest::findOrFail($id);
    $req->update(['status' => 'rejected']);
    session()->flash('message', 'Withdrawal rejected.');
}
    public function render()
    {
        return view('livewire.admin.withdrawal-requests', [
        'requests' => WithdrawalRequest::with(['venture', 'user'])->latest()->get()
    ]);
    }
}

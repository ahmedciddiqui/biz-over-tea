<?php

namespace App\Http\Livewire\Admin\Venture;

use App\Models\User;
use App\Models\UserGroup;
use App\Models\VentureModel;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class VentureDetails extends Component
{
    public $venture;
    public $investments = [];

    public $selectedUsers = [];
    public $selectAll = false;

    public $groupName;
    public $showGroupModal = false;

    public $totalInvested = 0;
    public $totalInvestors = 0;

    //public $investments;

    public function mount($ventureId)
    {
        $this->venture = VentureModel::with('investments.user')->findOrFail($ventureId);
        //dd($this->venture);
        $this->investments = $this->venture->investments;
        //dd($this->investments);
        $this->groupName = $this->venture->name . ' Investors';

        $this->totalInvested = $this->venture->funds_raised * $this->venture->one_ticket_amount;
        $this->totalInvestors = $this->investments->unique('user_id')->count();
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = $this->investments
                ->pluck('user_id')
                ->unique()
                ->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }



    public function saveGroup()
    {
        $this->validate([
            'groupName' => 'required|string|max:255'
        ]);

        //dd($this->selectedUsers);

        if (count($this->selectedUsers) === 0) {
            session()->flash('error', 'Please select at least one user to create a group.');
            return;
        }

        UserGroup::create([
            'name' => $this->groupName,
            'user_ids' => $this->selectedUsers
        ]);

        $this->showGroupModal = false;
        $this->groupName = '';
        $this->selectedUsers = [];
        $this->selectAll = false;

        session()->flash('message', 'Group created successfully.');
    }


    public function render(VentureModel $venture)
    {
        return view('livewire.admin.venture.details');
    }
}

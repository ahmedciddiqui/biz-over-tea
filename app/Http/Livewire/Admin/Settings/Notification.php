<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\User;
use App\Models\UserGroup;
use App\Notifications\SystemNotification;
use Livewire\Component;

class Notification extends Component
{
    public $sendType = 'users'; // users | groups

    public $users = [];
    public $groups = [];

    public $selectedUsers = [];
    public $selectedGroups = [];

    public $subject;
    public $message;

    public function mount()
    {
        $this->users = User::role('Investor')->orderBy('name')->get();
        $this->groups = UserGroup::orderBy('name')->get();
        //dd($this->groups);
    }

    public function updatedSendType($value)
    {
        // Clear selections
        
        $this->selectedUsers = [];
        $this->selectedGroups = [];

        // Tell browser to reset Select2
        $this->dispatchBrowserEvent('reset-select2');
    }



    public function sendNotification()
    {
        $this->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $recipients = collect();
        //dd($this->sendType);

        if ($this->sendType === 'users') {
            if (empty($this->selectedUsers)) {
                $this->addError('selectedUsers', 'Please select at least one user.');
                return;
            }

            $recipients = User::whereIn('id', $this->selectedUsers)->get();
        }

        if ($this->sendType === 'groups') {
            if (empty($this->selectedGroups)) {
                $this->addError('selectedGroups', 'Please select at least one group.');
                return;
            }

            $userIds = UserGroup::whereIn('id', $this->selectedGroups)
                ->pluck('user_ids')
                ->flatten()
                ->unique();

            $recipients = User::whereIn('id', $userIds)->get();
        }

        //dd($recipients, $this->subject, $this->message);

        // QUEUE SAFE NOTIFICATION
        \Illuminate\Support\Facades\Notification::send(
            $recipients,
            new SystemNotification(
                $this->subject,
                ['message'=>$this->message],
                'View Dashboard',
                route('investor.dashboard'),
                true,
                'website.emails.common_format'
            )
        );

        $this->reset([
            'selectedUsers',
            'selectedGroups',
            'subject',
            'message'
        ]);

        $this->dispatchBrowserEvent('resetSelect2');

        session()->flash('message', 'Notification sent successfully.');
    }
    public function render()
    {
        return view('livewire.admin.settings.notification');
    }
}

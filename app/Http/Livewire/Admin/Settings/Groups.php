<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\User;
use App\Models\UserGroup;
use Livewire\Component;

class Groups extends Component
{
    public $groups;
    public $selectedGroup;
    public $groupUsers = [];
    public $showUsersModal = false;

    public $showCreateModal = false;
    public $allUsers = [];
    public $name='';
    public $selectedUsers =[];

    private function defaultGroup(){
        $defaultName= 'Default Group';
        $investors = User::role('Investor')->pluck('id')->toArray();

        UserGroup::updateOrCreate(
            ['name' => $defaultName],   
            ['user_ids' => $investors] 
        );
    }

    public function mount()
    {
        $this->defaultGroup();
        $this->loadGroups();

        $this->allUsers = User::role('Investor')
        ->orderBy('name')
        ->get();
    }

    public function create()
    {
        $this->reset(['name', 'selectedUsers']);
        $this->showCreateModal = true;
    }


    public function loadGroups()
    {
        $this->groups = UserGroup::latest()->get();
    }

     public function viewGroupUsers($groupId)
    {
        $this->selectedGroup = UserGroup::findOrFail($groupId);

        $this->groupUsers = User::whereIn(
            'id',
            $this->selectedGroup->user_ids
        )->get();

        $this->showUsersModal = true;
    }

     public function deleteGroup($groupId)
    {
        UserGroup::findOrFail($groupId)->delete();
        $this->loadGroups();

        session()->flash('message', 'Group deleted successfully.');
    }

    public function saveGroup()
    {
        $this->validate([
            'name' => 'unique:user_groups|required|string|max:255',
            'selectedUsers' => 'required|array|min:1',
        ]);

        UserGroup::create([
            'name' => $this->name,
            'user_ids' => $this->selectedUsers,
        ]);

        $this->showCreateModal = false;

        session()->flash('message', 'Group created successfully.');

        $this->loadGroups(); // reload table
    }
    public function render()
    {
        return view('livewire.admin.settings.groups');
    }
}

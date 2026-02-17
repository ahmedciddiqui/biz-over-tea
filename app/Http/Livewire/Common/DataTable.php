<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public $model;         // Eloquent model (string)
    public $columns = [];  // Columns to display
    public $searchable = []; // Searchable fields
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 10;
    
    public $actions = false;
    protected $paginationTheme = 'tailwind';

    public function mount($model, $columns, $searchable = [], $actions = false)
    {
        $this->model = $model;
        $this->columns = $columns;
        $this->searchable = $searchable;
        $this->actions = $actions;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    public function render()
    {
        $query = $this->model::query();

        if ($this->search && count($this->searchable)) {
            $query->where(function ($q) {
                foreach ($this->searchable as $field) {
                    $q->orWhere($field, 'like', '%' . $this->search . '%');
                }
            });
        }

        $records = $query->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.common.data-table', [
            'records' => $records,
        ]);
    }
}

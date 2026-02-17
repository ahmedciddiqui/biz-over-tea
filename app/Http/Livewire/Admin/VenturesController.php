<?php

namespace App\Http\Livewire\Admin;

use App\Models\VentureModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class VenturesController extends Component
{
    use WithFileUploads;

    public $name, $description, $funding_goal, $one_ticket_amount, $total_ticket_quantity,$min_investment_ticket, $max_investment_ticket ,$ventureId, $commit_date;
    public $ventures;
    public $showModal = false;

    // file inputs
    public $images = [];      // array for multiple images
    public $existingImages = []; // existing stored images (paths)
    public $document; 

    protected $rules = [
        'name' => 'required|string|max:255',
        'funding_goal' => 'required|numeric|min:1000',
        'one_ticket_amount' => 'nullable|numeric|min:100',
        'total_ticket_quantity' => 'nullable|numeric|min:1',
        'min_investment_ticket' => 'nullable|numeric|min:1',
        'max_investment_ticket' => 'nullable|numeric|min:1',
        'images.*' => 'image|max:2048', // each image max 2MB
        'document' => 'nullable|max:5120', // 5MB
        'commit_date' => 'required|date',
    ];
    
    public function create()
    {
        //dd('here');
        $this->resetFields();
        $this->showModal = true;
    }
    
    public function updatedFundingGoal()
    {
        $this->calculateTickets();
    }

    public function updatedOneTicketAmount()
    {
        $this->calculateTickets();
    }

    private function calculateTickets()
    {
        if (
            $this->funding_goal > 0 &&
            $this->one_ticket_amount > 0
        ) {
            $this->total_ticket_quantity = (int) floor(
                $this->funding_goal / $this->one_ticket_amount
            );
        } else {
            $this->total_ticket_quantity = 0;
        }
    }

 

    public function save()
    {
        //dd('here');
        $this->validate();

        if (
            $this->funding_goal !=
            ($this->one_ticket_amount * $this->total_ticket_quantity)
        ) {
            $this->addError(
                'funding_goal',
                'Total investment must be divisible by ticket amount.'
            );
            return;
        }


        if ($this->min_investment_ticket > $this->max_investment_ticket) {
            $this->addError('min_investment_ticket', 'Min tickets cannot exceed max tickets.');
            return;
        }

        if ($this->max_investment_ticket > $this->total_ticket_quantity) {
            $this->addError('max_investment_ticket', 'Max tickets cannot exceed total tickets.');
            return;
        }

        //dd('here');
        
        $venture =VentureModel::updateOrCreate(
            ['id' => $this->ventureId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'funding_goal' => $this->funding_goal,
                'min_investment_ticket' => $this->min_investment_ticket,
                'max_investment_ticket' => $this->max_investment_ticket,
                'commit_date' => $this->commit_date,
                'one_ticket_amount' => $this->one_ticket_amount,
                'total_ticket_quantity' => $this->total_ticket_quantity,
            ]
        );

        $finalImages = $this->existingImages ?? [];

        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                // create unique filename
                $filename = 'ventures/' . Str::random(12) . '_' . $img->getClientOriginalName();
                $path = $img->storeAs('ventures', basename($filename), 'public');
                $finalImages[] = $path;
            }
        }

        $venture->images = $finalImages;
        if ($this->document instanceof \Livewire\TemporaryUploadedFile) {
            // new upload
            // delete old doc if exists
            if ($venture->document && Storage::disk('public')->exists($venture->document)) {
                Storage::disk('public')->delete($venture->document);
            }

            $docName = 'ventures/docs/' . Str::random(12) . '_' . $this->document->getClientOriginalName();
            $docPath = $this->document->storeAs('ventures/docs', basename($docName), 'public');
            $venture->document = $docPath;
        } elseif (is_string($this->document)) {
            // user kept existing document (no-op)
            $venture->document = $this->document;
        } else {
            // no document selected
            $venture->document = $venture->document ?? null;
        }

        $venture->save();


        $this->resetFields();
        $this->showModal = false; // open modal
        session()->flash('message', 'Venture saved successfully.');
    }

    public function edit($id)
    {
        $venture = VentureModel::findOrFail($id);
        $this->ventureId = $venture->id;
        $this->name = $venture->name;
        $this->description = $venture->description;
        $this->funding_goal = $venture->funding_goal;
        $this->min_investment_ticket = $venture->min_investment_ticket;
        $this->max_investment_ticket = $venture->max_investment_ticket;
        $this->commit_date = $venture->commit_date;
        $this->one_ticket_amount = $venture->one_ticket_amount;
        $this->total_ticket_quantity = $venture->total_ticket_quantity;
        $this->existingImages = $venture->images ?? [];
        $this->document = $venture->document;

        $this->showModal = true; // open modal
    }

    public function updateStatus($ventureId, $status)
    {
        if (!in_array($status, ['purposed', 'active', 'closed'])) {
            return;
        }

        VentureModel::where('id', $ventureId)->update([
            'status' => $status
        ]);
    }


    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            $path = $this->existingImages[$index];
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            array_splice($this->existingImages, $index, 1);
        }
    }

    public function removeNewImage($index)
    {
        // when user selected new image and wants to remove before save
        if (isset($this->images[$index])) {
            array_splice($this->images, $index, 1);
        }
    }

     public function removeDocument()
    {
        if ($this->document && is_string($this->document)) {
            // existing stored doc path
            if (Storage::disk('public')->exists($this->document)) {
                Storage::disk('public')->delete($this->document);
            }
            $this->document = null;
        } else {
            // if it's a newly selected upload, just reset
            $this->document = null;
        }
    }

    public function delete($id)
    {
        VentureModel::findOrFail($id)->delete();
        session()->flash('message', 'Venture deleted successfully.');
    }

    private function resetFields()
    {
        $this->ventureId = null;
        $this->name = '';
        $this->description = '';
        $this->funding_goal = '';
        $this->min_investment_ticket = '';
        $this->max_investment_ticket = '';
        $this->commit_date = '';
        $this->one_ticket_amount = '';
        $this->total_ticket_quantity = '';
        $this->images = [];
        $this->existingImages = [];
        $this->document = null;
    }

    


    

    public function render()
    {
        $this->ventures = VentureModel::latest()->get();
        //dd($this->ventures);    
        return view('livewire.admin.ventures');
    }
}

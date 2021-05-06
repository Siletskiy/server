<?php

namespace App\Http\Livewire;

use App\StickerSection;
use Livewire\Component;
use Livewire\WithPagination;

class StickerSectionIndex extends Component
{
    use WithPagination;

    public $search;

    public $length;

    public function mount()
    {
        $this->length = '10';
    }

    public function updatingLength()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = StickerSection::query();
        if ($this->search) {
            $query->where('name', 'like', "%$this->search%");
        }

        $sections = $query->latest()->paginate($this->length);
        return view('livewire.sticker-section-index', compact('sections'));
    }
}

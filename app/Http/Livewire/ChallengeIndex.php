<?php

namespace App\Http\Livewire;

use App\Challenge;
use Livewire\Component;
use Livewire\WithPagination;

class ChallengeIndex extends Component
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
        $query = Challenge::query();
        if ($this->search) {
            $query->where('hashtag', 'like', "%$this->search%");
        }

        $challenges = $query->latest()->paginate($this->length);
        return view('livewire.challenge-index', compact('challenges'));
    }
}

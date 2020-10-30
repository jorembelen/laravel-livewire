<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class PostDatatable extends Component
{
    use WithPagination;

    public $headers;
    public $searchTerm;
    public $sortDirection = 'asc';
    public $sortColumn = 'created_at';

    private function headerConfig()
    {
        return [
            'id' => '#',
            'featured_image' => [
                'label' => 'Featured Image',
                'func' => function($value) {
                    if(!empty($value))
                        return '<img width="100px" src="'.url('storage/photos/'. $value).'" />';
                    else
                        return 'No Featured Image';
                }
            ],
            'title' => 'Title',
            'content' => 'Content',
            'created_at' => [
                'label' => 'Created At',
                'func' => function($value) {
                    return $value->diffForHumans();
                }
            ],
        ];
    }

    public function mount()
    {
        $this->headers = $this->headerConfig();
    }
    
    public function hydrate()
    {
        $this->headers = $this->headerConfig();
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Post::where(function ($query) {
            $query->where('user_id', '=', auth()->user()->id);

            if($this->searchTerm != '') {
                $query->where('title', 'like', '%'.$this->searchTerm. '%');
                $query->orWhere('content', 'like', '%'.$this->searchTerm. '%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(5);
    }

    public function render()
    {
        return view('livewire.post-datatable', [
            'data' => $this->resultData()
        ]);
    }
}

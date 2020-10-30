<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class Posts extends Component
{
    use WithPagination;
    public $action, $selectedItem;


    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($postId, $action)
    {
        $this->selectedItem = $postId;
        
        if($action == 'delete')
        {
            // This will show the delete modal on frontend
            $this->dispatchBrowserEvent('openDeleteModal');
        } elseif ($action == 'showPhotos') {
            // Pass the currently selected item
            $this->emit('getPostId', $this->selectedItem);
            // Show for the modal of additional photos
            $this->dispatchBrowserEvent('openmodalShowPhotos');
        } else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openModal');
        }
    }

    public function delete()
    {
        // Get the specific record
        $model = Post::find($this->selectedItem);

        // Delete the photo
        \Storage::delete('public/photos/'.$model->featured_image);
        \Storage::delete('public/photos_thumb/'.$model->featured_image);

        Post::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('closeDeleteModal');
    }


    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::where('user_id', '=', auth()->user()->id)->paginate(7)
        ]);
    }
}

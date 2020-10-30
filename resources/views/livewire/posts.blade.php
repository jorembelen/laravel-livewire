<div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
            Add Post
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Save Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                @livewire('post-form')
                </div>
                
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalShowPhotos" tabindex="-1" aria-labelledby="modalShowPhotosLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowPhotosLabel">Additional Photos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                @livewire('post-additional-photos')
                </div>
                
                </div>
            </div>
            </div>

            <!-- DeleteModal -->

            <!-- Modal -->
            <div class="modal fade" id="modalFormDelete" tabindex="-1" aria-labelledby="modalFormDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormDeleteLabel">Delete Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>Do you wish to continue?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="delete">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- End DeleteModal -->

            <div>
            <br>
                        @if($posts->count())
                    <table class="table table-striped">
                        <thead>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post )
                            <tr>
                            <td>
                            @if(!empty($post->featured_image))
                                <img src="{{ url('storage/photos_thumb/'. $post->featured_image) }}" alt="" width="100px">
                            @else
                                No featured Image available!
                            @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                            <button class="btn btn-sm btn-success" wire:click="selectItem({{ $post->id }}, 'update')">Update</button>
                            <button class="btn btn-sm btn-danger" wire:click="selectItem({{ $post->id }}, 'delete')">Delete</button>
                            <button class="btn btn-sm btn-primary" wire:click="selectItem({{ $post->id }}, 'showPhotos')">Photos</button>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $posts->links() }}
                @endif
            </div>

</div>

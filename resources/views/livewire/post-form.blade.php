<div>
<label for="">Featured Image</label>
<input type="file" class="form-control" wire:model="featuredImage">
<br>
<label for="">Photos</label>
<input type="file" class="form-control" wire:model="additionalPhotos" multiple>
<br>
<label for="">Title</label>
    <input wire:model="title" type="text" class="form-control">
    @if ($errors->has('title'))
        <p style="color: red;">{{ $errors->first('title') }}</p>
    @endif
    <br>
    <label for="">Content</label>
    <textarea wire:model="content" type="text" class="form-control"></textarea>
    @if ($errors->has('content'))
        <p style="color: red;">{{ $errors->first('content') }}</p>
    @endif
    <br>
    <button class="btn btn-primary"  type="button" wire:click="save">Save</button>
</div>

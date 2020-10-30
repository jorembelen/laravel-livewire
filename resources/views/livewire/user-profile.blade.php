<div>
 <label for="">Name</label>
 <input type="text" class="form-control" wire:model="name">
        @if ($errors->has('name'))
            <p style="color: red;">{{ $errors->first('name') }}</p>
        @endif
 <label for="">Email</label>
 <input type="email" class="form-control" wire:model="email">
        @if ($errors->has('email'))
            <p style="color: red;">{{ $errors->first('email') }}</p>
        @endif
<br>
        @if($email !== $prevEmail)
            <label for="">Current Password</label>
            <input type="password" class="form-control" wire:model="current_password_for_email">
                @if ($errors->has('current_password_for_email'))
                    <p style="color: red;">{{ $errors->first('current_password_for_email') }}</p>
                @endif
        @endif
        <br>
        <label for="">Password</label>
            <input type="password" class="form-control" wire:model="password">
                @if ($errors->has('password'))
                    <p style="color: red;">{{ $errors->first('password') }}</p>
                @endif
        @if(!empty($password))
        <label for="">Password Confirmation</label>
            <input type="password" class="form-control" wire:model="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <p style="color: red;">{{ $errors->first('password_confirmation') }}</p>
                @endif
        <label for="">Current Password</label>
        <input type="password" class="form-control" wire:model="current_password_for_password">
            @if ($errors->has('current_password_for_password'))
                <p style="color: red;">{{ $errors->first('current_password_for_password') }}</p>
            @endif
        @endif
<br>
    <button class="btn btn-primary" wire:click="save">Save</button>

</div>

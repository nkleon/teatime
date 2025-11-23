<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT') 

    <div>
        <label for="role_id">Role</label>
        <select name="role_id" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" 
                    {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role_id') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <input type="checkbox" id="active" name="active" value="1" 
               {{ old('active', $user->active) ? 'checked' : '' }}>
        <label for="active">User is Active</label>
    </div>
    
    <h3>Change Password (Optional)</h3>
    <div>
        <label for="password">New Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation">
        @error('password') <span>{{ $message }}</span> @enderror
    </div>

    <button type="submit">Update User</button>
</form>
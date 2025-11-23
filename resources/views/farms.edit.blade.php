<form method="POST" action="{{ route('farms.update', $farm->id) }}">
    @csrf
    @method('PUT') <h2>Edit Farm: {{ $farm->name }}</h2>

    <div>
        <label for="name">Farm Name</label>
        <input type="text" id="name" name="name" 
               value="{{ old('name', $farm->name) }}" required>
        @error('name') <span>{{ $message }}</span> @enderror
    </div>
    
    <button type="submit">Update Farm</button>
</form>
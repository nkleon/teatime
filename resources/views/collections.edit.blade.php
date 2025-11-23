<form method="POST" action="{{ route('collections.update', $collection->id) }}">
    @csrf
    @method('PUT') 

    <h2>Edit Collection</h2>

    <div>
        <label for="date">Date of Collection</label>
        <input type="date" name="date" 
               value="{{ old('date', $collection->date) }}" required>
        @error('date') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="farm_id">Farm</label>
        <select name="farm_id" required>
            @foreach ($farms as $farm)
                <option value="{{ $farm->id }}" 
                    {{ (old('farm_id', $collection->farm_id) == $farm->id) ? 'selected' : '' }}>
                    {{ $farm->name }}
                </option>
            @endforeach
        </select>
        @error('farm_id') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="picker_id">Picker (User)</label>
        <select name="picker_id" required>
            @foreach ($pickers as $picker)
                <option value="{{ $picker->id }}" 
                    {{ (old('picker_id', $collection->picker_id) == $picker->id) ? 'selected' : '' }}>
                    {{ $picker->name }}
                </option>
            @endforeach
        </select>
        @error('picker_id') <span>{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="quantity">Quantity Picked</label>
        <input type="number" step="0.01" name="quantity" 
               value="{{ old('quantity', $collection->quantity) }}" required>
        @error('quantity') <span>{{ $message }}</span> @enderror
    </div>

    <button type="submit">Update Collection</button>
</form>
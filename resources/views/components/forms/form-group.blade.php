@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false, 'placeholder' => '', 'options' => [], 'readonly' => false, 'step' => null, 'min' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    @if($type === 'select')
        <select class="form-select @error($name) is-invalid @enderror" 
                id="{{ $name }}" 
                name="{{ $name }}" 
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly' : '' }}>
            <option value="">{{ $placeholder ?: 'Choose...' }}</option>
            @foreach($options as $option)
                <option value="{{ $option['value'] ?? $option }}" 
                        {{ $value == ($option['value'] ?? $option) ? 'selected' : '' }}>
                    {{ $option['label'] ?? $option }}
                </option>
            @endforeach
        </select>
    @elseif($type === 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" 
                  id="{{ $name }}" 
                  name="{{ $name }}" 
                  {{ $required ? 'required' : '' }}
                  {{ $readonly ? 'readonly' : '' }}
                  placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    @else
        <input type="{{ $type }}" 
               class="form-control @error($name) is-invalid @enderror" 
               id="{{ $name }}" 
               name="{{ $name }}" 
               value="{{ $value }}"
               {{ $required ? 'required' : '' }}
               {{ $readonly ? 'readonly' : '' }}
               {{ $step ? "step={$step}" : '' }}
               {{ $min ? "min={$min}" : '' }}
               placeholder="{{ $placeholder }}">
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 
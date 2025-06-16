{{-- Form Input Component --}}
@php
$componentProps = [
    'type' => $type ?? 'text',
    'name' => $name ?? '',
    'id' => $id ?? ($name ?? 'input'),
    'class' => 'form-input ' . ($class ?? ''),
    'placeholder' => $placeholder ?? '',
    'value' => old($name ?? '', $value ?? ''),
    'required' => $required ?? false
];
@endphp

<div class="form-group">
    @if(($label ?? '') !== false)
        <label for="{{ $componentProps['id'] }}" class="form-label">
            {{ $label ?? '' }}
            @if($componentProps['required'])
                <span style="color: #dc3545;">*</span>
            @endif
        </label>
    @endif
    
    @if(($type ?? 'text') === 'textarea')
        <textarea 
            name="{{ $componentProps['name'] }}" 
            id="{{ $componentProps['id'] }}"
            class="{{ $componentProps['class'] }} form-textarea"
            placeholder="{{ $componentProps['placeholder'] }}"
            @if($componentProps['required']) required @endif
            @if(($rows ?? false)) rows="{{ $rows }}" @endif
        >{{ $componentProps['value'] }}</textarea>
    @elseif(($type ?? 'text') === 'select')
        <select 
            name="{{ $componentProps['name'] }}" 
            id="{{ $componentProps['id'] }}"
            class="form-select"
            @if($componentProps['required']) required @endif
        >
            @if($componentProps['placeholder'])
                <option value="">{{ $componentProps['placeholder'] }}</option>
            @endif
            @foreach(($options ?? []) as $optValue => $optLabel)
                <option value="{{ $optValue }}" 
                    {{ old($componentProps['name'], $value ?? '') == $optValue ? 'selected' : '' }}>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>
    @else
        <input 
            type="{{ $componentProps['type'] }}" 
            name="{{ $componentProps['name'] }}" 
            id="{{ $componentProps['id'] }}"
            class="{{ $componentProps['class'] }}"
            placeholder="{{ $componentProps['placeholder'] }}"
            value="{{ $componentProps['value'] }}"
            @if($componentProps['required']) required @endif
            @if(($accept ?? false)) accept="{{ $accept }}" @endif
        >
    @endif
    
    @error($componentProps['name'])
        <div class="error-message">{{ $message }}</div>
    @enderror
</div> 
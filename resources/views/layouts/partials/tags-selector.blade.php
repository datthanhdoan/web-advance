{{-- Tags Selector Component --}}
<div class="form-group">
    <label class="form-label">{{ $label ?? 'Thẻ' }}</label>
    
    <div id="tags-container" class="tags-container">
        {{-- Selected tags will appear here --}}
        @if(isset($selectedTags) && is_array($selectedTags))
            @foreach($selectedTags as $tagId)
                @php
                    $selectedTag = ($tags ?? collect())->firstWhere('id', $tagId);
                @endphp
                @if($selectedTag)
                    <span class="selected-tag" data-tag-id="{{ $selectedTag->id }}">
                        #{{ $selectedTag->name }}
                        <button type="button" class="remove-tag">&times;</button>
                        <input type="hidden" name="tags[]" value="{{ $selectedTag->id }}">
                    </span>
                @endif
            @endforeach
        @endif
    </div>
    
    <div class="available-tags">
        @foreach(($tags ?? []) as $tag)
            <button type="button" 
                    class="available-tag" 
                    data-tag-id="{{ $tag->id }}" 
                    data-tag-name="{{ $tag->name }}">
                #{{ $tag->name }}
            </button>
        @endforeach
    </div>
    
    @error($name ?? 'tags')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>

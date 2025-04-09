@props(['name', 'rows' => 3, 'label' => false, 'text' => '', 'placeholder' => null, 'messages' => null])

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" class="mb-1">{{ $label }}</label>
    @endif
    <textarea name="{{ $name }}"
              id="{{ $name }}"
              class="form-control"
              rows="{{ $rows }}"
              placeholder="{{ $placeholder }}"
    {{ $attributes }}>{{ $text }}</textarea>
    <x-input-error :messages="$messages"/>
</div>








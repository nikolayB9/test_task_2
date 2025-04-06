@props(['name', 'label' => null, 'checked' => false])

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" name="{{ $name }}" class="custom-control-input" id="{{ $name }}" @checked($checked)>
        <label class="custom-control-label" for="{{ $name }}">{{ $label }}</label>
    </div>
</div>




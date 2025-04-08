@props([
    'name',
    'value' => old($name),
    'label' => null,
    'placeholder' => null,
    'messages' => null,
    'id' => null,
])

<div class="form-group">
    <div class="input-group">
        @if($label)
            <label for="{{ $id ?? $name }}" class="mb-1">{{ $label }}</label>
        @endif
        <input type="password"
               name="{{ $name }}"
               id="{{ $id ?? $name }}"
               class="form-control"
               placeholder="{{ $placeholder }}">
        <div class="input-group-append">
        <span class="input-group-text toggle-password" style="cursor: pointer;" data-target="#{{ $id ?? $name }}">
            <i class="fa fa-eye"></i>
        </span>
        </div>
        <x-input-error :messages="$messages"/>
    </div>
</div>

@pushonce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', () => {
                    const input = document.querySelector(button.dataset.target);
                    const icon = button.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
@endpushonce


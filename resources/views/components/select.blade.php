@props([
    'name' => '',
    'options' => [],
    'selected' => null,
    'attributes' => [],
    'model' => null
])

<select
    name="{{ $name }}"
    x-model="{{ $model }}"
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'])->only('class') }}
>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

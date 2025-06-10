@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#5f7f4f] dark:text-[#5f7f4f]']) }}>
    {{ $value ?? $slot }}
</label>

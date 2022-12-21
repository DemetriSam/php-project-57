@php
    $multiple = $multiple ?? false;
    $arrayName = $multiple ? $name . '[]' : $name;
    $label = $label ?? true;
@endphp
<div>
    @if ($label)
        <small>{{ Form::label($arrayName, __('views.' . $entity . '.fields.' . $name)) }}</small>
    @endif
    {{ Form::select($arrayName, $items ?? [], null, [
        'placeholder' => __('views.' . $entity . '.fields.' . $name),
        'multiple' => $multiple ?? false,
        'required' => $required ?? false,
        'autofocus' => $autofocus ?? false,
        'selected' => 'selected',
        'class' => [
            'block',
            'border-gray-300',
            'focus:border-indigo-500',
            'focus:ring-indigo-500',
            'rounded-md',
            'shadow-sm',
            'block',
            'mt-1',
            'w-full',
        ],
    ]) }}
</div>

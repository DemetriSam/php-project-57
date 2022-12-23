<x-app-layout>
    <x-slot name="title">{{ __('views.label.pages.edit.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.label.pages.edit.title') }}
    </x-slot>
    <x-form-card>
        {{ Form::model($label, [
            'route' => ['labels.update', $label->id],
            'method' => 'PATCH',
            'class' => 'flex flex-col gap-3',
        ]) }}
        <x-text-input-block entity="label" name="name" autofocus />
        <x-text-input-block entity="label" name="description" />
        <x-submit entity="label" type="edit" />
        {{ Form::close() }}


    </x-form-card>
</x-app-layout>

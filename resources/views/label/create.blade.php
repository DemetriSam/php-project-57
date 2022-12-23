<x-app-layout>
    <x-slot name="title">{{ __('views.label.pages.create.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.label.pages.create.title') }}
    </x-slot>
    <x-form-card>
        {{ Form::model($label, ['route' => 'labels.store', 'class' => 'flex flex-col gap-3']) }}
        <x-text-input-block entity="label" name="name" autofocus />
        <x-text-input-block entity="label" name="description" />
        <x-submit entity="label" type="create" />
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>

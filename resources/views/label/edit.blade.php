<x-app-layout>
    <x-slot name="title">{{ __('views.label.pages.edit.title') }}</x-slot>
    <x-slot name="header">
        <h1>{{ __('views.label.pages.edit.title') }}</h1>
        {{ Form::model($label, [
            'route' => ['labels.update', $label->id],
            'method' => 'DELETE',
        ]) }}
        {{ Form::submit(__('views.delete'), ['class' => ['mt-4', 'inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-gray-700', 'focus:bg-gray-700', 'active:bg-gray-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2', 'transition', 'ease-in-out', 'duration-150']]) }}
        {{ Form::close() }}
    </x-slot>
    <x-form-card>
        {{ Form::model($label, [
            'route' => ['labels.update', $label->id],
            'method' => 'PATCH',
        ]) }}
        <div>
            <x-text-input-block entity="label" name="name" required autofocus />
            <x-text-input-block entity="label" name="description" />
            <x-submit entity="label" type="edit" />
        </div>
        {{ Form::close() }}


    </x-form-card>
</x-app-layout>

<x-app-layout>
    <x-slot name="title">Редактировать статус задачи</x-slot>
    <x-slot name="header">
        <h1>Редактировать статус задачи</h1>
        {{ Form::model($taskStatus, [
            'route' => ['task_statuses.update', $taskStatus->id],
            'method' => 'DELETE',
        ]) }}
        {{ Form::submit('Удалить', ['class' => ['mt-4', 'inline-flex', 'items-center', 'px-4', 'py-2', 'bg-red-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-gray-700', 'focus:bg-gray-700', 'active:bg-gray-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2', 'transition', 'ease-in-out', 'duration-150']]) }}

        {{ Form::close() }}
    </x-slot>
    <x-form-card>
        {{ Form::model($taskStatus, [
            'route' => ['task_statuses.update', $taskStatus->id],
            'method' => 'PATCH',
        ]) }}
        <div>
            <div>
                <small>{{ Form::label('name', 'Имя') }}</small>
                {{ Form::text('name', null, ['required', 'autofocus', 'class' => ['border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500', 'rounded-md', 'shadow-sm', 'block', 'mt-1', 'w-full']]) }}
            </div>
            {{ Form::submit('Сохранить', ['class' => ['mt-4', 'inline-flex', 'items-center', 'px-4', 'py-2', 'bg-gray-800', 'border', 'border-transparent', 'rounded-md', 'font-semibold', 'text-xs', 'text-white', 'uppercase', 'tracking-widest', 'hover:bg-gray-700', 'focus:bg-gray-700', 'active:bg-gray-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2', 'transition', 'ease-in-out', 'duration-150']]) }}
        </div>
        {{ Form::close() }}


    </x-form-card>
</x-app-layout>

<x-app-layout>
    <x-slot name="title">Создать статус задачи</x-slot>
    <x-slot name="header">
        <h1>Создать статус задачи</h1>
    </x-slot>
    <x-form-card>
        {{ Form::model($taskStatus, ['route' => 'task_statuses.store']) }}
        <div>
            <div>
                {{ Form::label('name', 'Имя', ['class' => ['red', 'big']]) }}
                {{ Form::text('name', null, ['class' => ['red', 'big']]) }}
            </div>
            {{ Form::submit('Создать') }}
        </div>
        {{ Form::close() }}
    </x-form-card>
</x-app-layout>

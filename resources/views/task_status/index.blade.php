<x-app-layout>
    <x-slot name="title">{{ __('views.status.pages.index.title') }}</x-slot>
    <x-slot name="header">
        {{ __('views.status.pages.index.title') }}
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @auth
                <div class="flex justify-center">
                    <a href="{{ route('task_statuses.create') }}">
                        <x-primary-button>
                            {{ __('views.status.pages.index.new') }}
                        </x-primary-button>
                    </a>
                </div>
            @endauth
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="max-w-xxl">
                    <table class="w-full">
                        <thead class="border-b-2 border-solid border-black text-left">
                            <tr>
                                <th>{{ __('views.status.fields.id') }}</th>
                                <th>{{ __('views.status.fields.name') }}</th>
                                <th>{{ __('views.status.fields.created_at') }}</th>
                                @auth
                                    <th>{{ __('views.actions.column_name') }}</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taskStatuses as $status)
                                <tr class="border-b border-dashed text-left">
                                    <td>{{ $status->id }}</td>
                                    <td>
                                        <a class="text-blue-600 hover:text-blue-900"
                                            href="{{ route('task_statuses.show', ['task_status' => $status->id]) }}">
                                            {{ $status->name }}
                                        </a>
                                    </td>
                                    <td>{{ $status->created_at }}</td>
                                    @auth
                                        <td>
                                            <a data-confirm="Вы уверены?" data-method="delete"
                                                class="text-red-600 hover:text-red-900"
                                                href="{{ route('task_statuses.destroy', $status->id) }}">
                                                {{ __('views.actions.delete') }} </a>
                                            <a
                                                href="{{ route('task_statuses.edit', ['task_status' => $status->id]) }}">{{ __('views.actions.edit') }}</a>
                                        </td>
                                    @endauth

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

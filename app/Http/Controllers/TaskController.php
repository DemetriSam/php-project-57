<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $statuses = TaskStatus::pluck('name', 'id');
        $execs = User::pluck('name', 'id');
        $creators = User::pluck('name', 'id');

        return view('task.index', compact('tasks', 'creators', 'statuses', 'execs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $execs = User::pluck('name', 'id');

        return view('task.create', compact('task', 'labels', 'statuses', 'execs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $formData = $request->all();
        $task = Auth::user()->createdTasks()->create($formData);

        if (collect($formData)->has('labels')) {
            $labels = collect($formData['labels'])
                        ->filter(fn($label) => $label !== null);
            $task->labels()->attach($labels);
        }


        flash(__('views.task.flash.store'));
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // @phpstan-ignore-next-line
        $labels = $task->labels;
        return view('task.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $execs = User::pluck('name', 'id');

        return view('task.edit', compact('task', 'labels', 'statuses', 'execs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $formData = $request->all();
        $task->fill($formData);
        $task->save();

        if (isset($formData['labels'])) {
            $labels = collect($formData['labels'])
                        ->filter(fn($label) => $label !== null);
            $task->labels()->sync($labels);
        }

        flash(__('views.task.flash.update'));
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {

        $task->delete();
        flash(__('views.task.flash.destroy.success'));

        return redirect()->route('tasks.index');
    }
}

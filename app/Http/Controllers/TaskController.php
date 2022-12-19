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

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('task.index', ['tasks' => Task::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        $statuses = TaskStatus::all()
            ->reduce(function($carry, $status) {
                $carry[$status->id] = $status->name;
                return $carry;
            });
        $labels = Label::all()
            ->reduce(function($carry, $label) {
                $carry[$label->id] = $label->name;
                return $carry;
            });
        $execs = User::all()
            ->reduce(function($carry, $user) {
                $carry[$user->id] = $user->name;
                return $carry;
            });

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
        // @phpstan-ignore-next-line
        $userId = Auth::user()->id;
        $task = Task::create(array_merge($formData, ['created_by_id' => $userId]));
        
        $task->labels()->attach($formData['labels']);

        flash('Задача успешно создана');
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
        $statuses = TaskStatus::all()
            ->reduce(function($carry, $status) {
                $carry[$status->id] = $status->name;
                return $carry;
            });

        $labels = Label::all()
            ->reduce(function($carry, $label) {
                $carry[$label->id] = $label->name;
                return $carry;
            });

        $execs = User::all()
            ->reduce(function($carry, $user) {
                $carry[$user->id] = $user->name;
                return $carry;
            });

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

        foreach ($formData as $key => $value) {
            if (in_array($key, ['_method', '_token', 'labels'])) {
                continue;
            }
            $task->$key = $value;
        }

        $task->save();
        $task->labels()->sync($formData['labels']);

        flash('Задача была изменена');
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
        if (Gate::allows('delete-task', $task)) {
            $task->delete();
            flash('Задача удалена');
        } else {
            flash('Нет прав на удаление');
        }

        return redirect()->route('tasks.index');
    }
}

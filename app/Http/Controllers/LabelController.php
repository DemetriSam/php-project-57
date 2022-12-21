<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Label $label)
    {
        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabelRequest $request)
    {
        $formData = $request->all();
        Label::create($formData);
        flash(__('views.label.flash.store'));
        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return view('label.show', compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabelRequest $request, Label $label)
    {
        $formData = $request->all();

        foreach ($formData as $key => $value) {
            if (in_array($key, ['_method', '_token'])) {
                continue;
            }
            $label->$key = $value;
        }

        $label->save();
        flash(__('views.label.flash.update'));
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        if ($label->tasks->isNotEmpty()) {
            flash(__('views.label.flash.destroy.fail.constraint'));
        } elseif (Gate::allows('do-things')) {
            $label->delete();
            flash(__('views.label.flash.destroy.success'));
        } else {
            flash(__('views.label.flash.destroy.fail.no-rights'));
        }

        return redirect()->route('labels.index');
    }
}

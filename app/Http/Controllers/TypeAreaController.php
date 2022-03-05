<?php

namespace App\Http\Controllers;

use App\Models\TypeArea;
use Illuminate\Http\Request;
use App\Http\Requests\TypeAreaStoreRequest;
use App\Http\Requests\TypeAreaUpdateRequest;

class TypeAreaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TypeArea::class);

        $typeAreas = TypeArea::all();

        return view('app.type_areas.index', compact('typeAreas'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TypeArea::class);

        return view('app.type_areas.create');
    }

    /**
     * @param \App\Http\Requests\TypeAreaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeAreaStoreRequest $request)
    {
        $this->authorize('create', TypeArea::class);

        $validated = $request->validated();

        $typeArea = TypeArea::create($validated);

        return redirect()
            ->route('type-areas.index')
            ->with('message', 'Se creó el tipo de área correctamente');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeArea $typeArea)
    {
        $this->authorize('view', $typeArea);

        return view('app.type_areas.show', compact('typeArea'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TypeArea $typeArea)
    {
        $this->authorize('update', $typeArea);

        return view('app.type_areas.edit', compact('typeArea'));
    }

    /**
     * @param \App\Http\Requests\TypeAreaUpdateRequest $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function update(TypeAreaUpdateRequest $request, TypeArea $typeArea)
    {
        $this->authorize('update', $typeArea);

        $validated = $request->validated();

        $typeArea->update($validated);

        return redirect()
            ->route('type-areas.index')
            ->with('message', 'Se editó el tipo de área correctamente');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TypeArea $typeArea)
    {
        $this->authorize('delete', $typeArea);

        $typeArea->delete();

        return redirect()
            ->route('type-areas.index')
            ->with('message', 'Se eliminó el tipo de área correctamente');
    }

}

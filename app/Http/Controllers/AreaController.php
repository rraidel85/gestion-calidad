<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\TypeArea;
use Illuminate\Http\Request;
use App\Http\Requests\AreaStoreRequest;
use App\Http\Requests\AreaUpdateRequest;

class AreaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Area::class);

        $areas = Area::all();

        return view('app.areas.index', compact('areas'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Area::class);

        $typeAreas = TypeArea::pluck('name', 'id');

        return view('app.areas.create', compact('typeAreas'));
    }

    /**
     * @param \App\Http\Requests\AreaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStoreRequest $request)
    {
        $this->authorize('create', Area::class);

        $validated = $request->validated();

        $area = Area::create($validated);

        return redirect()
            ->route('areas.edit', $area)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Area $area)
    {
        $this->authorize('view', $area);

        return view('app.areas.show', compact('area'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Area $area)
    {
        $this->authorize('update', $area);

        $typeAreas = TypeArea::pluck('name', 'id');

        return view('app.areas.edit', compact('area', 'typeAreas'));
    }

    /**
     * @param \App\Http\Requests\AreaUpdateRequest $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdateRequest $request, Area $area)
    {
        $this->authorize('update', $area);

        $validated = $request->validated();

        $area->update($validated);

        return redirect()
            ->route('areas.edit', $area)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Area $area)
    {
        $this->authorize('delete', $area);

        $area->delete();

        return redirect()
            ->route('areas.index')
            ->withSuccess(__('crud.common.removed'));
    }

}

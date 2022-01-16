<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeAreaResource;
use App\Http\Resources\TypeAreaCollection;
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

        $search = $request->get('search', '');

        $typeAreas = TypeArea::search($search)
            ->latest()
            ->paginate();

        return new TypeAreaCollection($typeAreas);
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

        return new TypeAreaResource($typeArea);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TypeArea $typeArea)
    {
        $this->authorize('view', $typeArea);

        return new TypeAreaResource($typeArea);
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

        return new TypeAreaResource($typeArea);
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

        return response()->noContent();
    }
}

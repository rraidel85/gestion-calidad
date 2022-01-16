<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeArea;
use Illuminate\Http\Request;
use App\Http\Resources\AreaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\AreaCollection;

class TypeAreaAreasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TypeArea $typeArea)
    {
        $this->authorize('view', $typeArea);

        $search = $request->get('search', '');

        $areas = $typeArea
            ->areas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AreaCollection($areas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TypeArea $typeArea
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TypeArea $typeArea)
    {
        $this->authorize('create', Area::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $area = $typeArea->areas()->create($validated);

        return new AreaResource($area);
    }
}

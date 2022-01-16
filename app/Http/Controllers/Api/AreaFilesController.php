<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileCollection;

class AreaFilesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Area $area)
    {
        $this->authorize('view', $area);

        $search = $request->get('search', '');

        $files = $area
            ->files()
            ->search($search)
            ->latest()
            ->paginate();

        return new FileCollection($files);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area)
    {
        $this->authorize('create', File::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'category_id' => ['required', 'exists:categories,id'],
            'access_level' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $file = $area->files()->create($validated);

        return new FileResource($file);
    }
}

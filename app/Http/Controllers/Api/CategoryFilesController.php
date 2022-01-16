<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileCollection;

class CategoryFilesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $files = $category
            ->files()
            ->search($search)
            ->latest()
            ->paginate();

        return new FileCollection($files);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $this->authorize('create', File::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'access_level' => ['required', 'numeric'],
            'area_id' => ['required', 'exists:areas,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $file = $category->files()->create($validated);

        return new FileResource($file);
    }
}

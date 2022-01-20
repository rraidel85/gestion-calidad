<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileCollection;

class UserFilesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $files = $user
            ->files()
            ->search($search)
            ->latest()
            ->paginate();

        return new FileCollection($files);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', File::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'category_id' => ['required', 'exists:categories,id'],
            'area_id' => ['required', 'exists:areas,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $file = $user->files()->create($validated);

        return new FileResource($file);
    }
}

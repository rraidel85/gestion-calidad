<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class AreaUsersController extends Controller
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

        $users = $area
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $area->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}

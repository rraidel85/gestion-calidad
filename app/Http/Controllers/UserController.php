<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStorePasswordRequest;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
// use Barryvdh\Debugbar\Facades\Debugbar;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', User::class);

        $user_role_name = $request->user()->roles->pluck('name')->first();
        $users = [];

        if ($user_role_name == 'Administrador') {
            $users = User::all();
        }
        elseif($user_role_name == 'Jefe de Área'){
            $users = User::where('area_id', $request->user()->area->id)->get();
        }
        
        return view('app.users.index', compact('users'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $user_role_name = $request->user()->roles->pluck('name')->first();
        $areas = [];
        $roles = [];
        
        if ($user_role_name == 'Administrador') {
            $areas = Area::pluck('name', 'id');
            $roles = Role::pluck('name', 'id');
        }
        elseif($user_role_name == 'Jefe de Área'){
            $roles = Role::where('name','!=','Administrador')->pluck('name', 'id');
        }
    
        return view('app.users.create', compact('areas', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();
        $defaultPassword = "password";

        $validated['password'] = Hash::make($defaultPassword);

        $user = User::create($validated);

        $user->syncRoles($request->rol_id);

        return redirect()
            ->route('users.index')
            ->with('message', 'Se creó el usuario correctamente');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $this->authorize('view', $user);

        return view('app.users.show', compact('user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $user_role_name = $request->user()->roles->pluck('name')->first();
        $areas = [];
        $roles = [];
        
        if ($user_role_name == 'Administrador') {
            $areas = Area::pluck('name', 'id');
            $roles = Role::pluck('name', 'id');
        }
        elseif($user_role_name == 'Jefe de Área'){
            $roles = Role::where('name','!=','Administrador')->pluck('name', 'id');
        }

        return view('app.users.edit', compact('user', 'areas', 'roles'));
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated = $request->validated();
        // if (empty($validated['password'])) {
        //     unset($validated['password']);
        // } else {
        //     $validated['password'] = Hash::make($validated['password']);
        // }

        $user->update($validated);

        $user->syncRoles($request->rol_id);

        return redirect()
            ->route('users.index')
            ->with('message', 'Se editó el usuario correctamente');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', 'Se eliminó el usuario correctamente');
    }

    public function profile(Request $request)
    {   
        $user = $request->user();

        return view('app.users.profile', compact('user'));
    }

    public function change_password(Request $request)
    {   
        $user = $request->user();

        return view('app.users.change_password', compact('user'));
    }

    public function store_password(UserStorePasswordRequest $request)
    {

        $validated = $request->validated();
        $user = $request->user();

        $hashedPassword = $user->password;

        if (Hash::check($validated['oldpassword'], $hashedPassword)) {
            $user->password = Hash::make($validated['password']);
            $user->save();
            return redirect()->route('home')
                    ->with('message', 'Se actualizó la contraseña correctamente');
        }

        return redirect()
            ->back()
            ->with('error', 'Contraseña actual incorrecta');
    }
}

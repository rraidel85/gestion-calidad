<?php
namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Area $area, User $user)
    {
        $this->authorize('update', $area);

        $area->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Area $area, User $user)
    {
        $this->authorize('update', $area);

        $area->users()->detach($user);

        return response()->noContent();
    }
}

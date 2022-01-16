<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AreaCollection;

class UserAreasController extends Controller
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

        $areas = $user
            ->areas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AreaCollection($areas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Area $area)
    {
        $this->authorize('update', $user);

        $user->areas()->syncWithoutDetaching([$area->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user, Area $area)
    {
        $this->authorize('update', $user);

        $user->areas()->detach($area);

        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Area;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\FileStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUpdateRequest;
// use Barryvdh\Debugbar\Facades\Debugbar;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show','files_by_area','download');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //    $this->authorize('view-any', File::class);
        $files = File::all();

        $categories = Category::all();
        
        return view('app.files.index', compact('files', 'categories'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', File::class);

        $categories = Category::all();

        return view(
            'app.files.create',
            compact('categories')
        );
    }

    /**
     * @param \App\Http\Requests\FileStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileStoreRequest $request)
    {
        $this->authorize('create', File::class);

        $validated = $request->validated();
        
        $file = new File;
        
        
        $file->name = $validated['name'];
        $file->area_id = $request->user()->area_id;
        $file->user_id = $request->user()->id;

        if ($request->hasFile('file')) {
            $file->file = $request->file('file')->store('public');
        }
        
        
        $file->save();

        if(!empty($validated['categories'])){
            $file->categories()->attach($validated['categories']);
        }

        return redirect()
            ->route('files.index')
            ->with('message', 'Se creó el documento correctamente');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, File $file)
    {
        // $this->authorize('view', $file);

        return view('app.files.show', compact('file'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, File $file)
    {
        $this->authorize('update', $file);

        $categories = Category::all();
        $areas = Area::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $file_categories = $file->categories->pluck('id');
        return view(
            'app.files.edit',
            compact('file', 'categories', 'areas', 'users', 'file_categories')
        );
    }

    /**
     * @param \App\Http\Requests\FileUpdateRequest $request
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function update(FileUpdateRequest $request, File $file)
    {
        $this->authorize('update', $file);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($file->file) {
                Storage::delete($file->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $file->update($validated);

        return redirect()
            ->route('files.index')
            ->with('message', 'Se actualizó el documento correctamente');
    } 

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\File $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, File $file)
    {
        $this->authorize('delete', $file);

        if ($file->file) {
            Storage::delete($file->file);
        }

        $file->delete();

        return redirect(url()->previous())
            ->with('message', 'Se eliminó el documento correctamente');
    }


    
    public function download($id)
    {
       $file =  File::findOrFail($id);

       if(!$file->file){ 
            return abort(404);     
       }
       
       $extension = pathinfo($file->file, PATHINFO_EXTENSION);

       return Storage::download($file->file,$file->name.'.'.$extension); 
       
    }

    public function files_by_area($area_id)
    {   
        $categories = Category::all();

        $files = File::where('area_id', $area_id)->get();

        return view('app.files.index', compact('files','categories'));
    }

    
}

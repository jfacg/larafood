<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use Illuminate\Http\Request;

use App\Models\Permission;

class PermissionController extends Controller
{
    private $repository;

    public function __construct(Permission $permission){
        $this->repository = $permission; 
    }

    public function index (){
        $permissions = $this->repository->latest()->paginate();
        return view('admin.pages.permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('permissions.index');
    }

    public function show ($id){
        $permission = $this->repository->find($id);

        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permissions.show', ['permission' => $permission]);
    }

    public function destroy ($id){
        $permission = $this->repository->find($id);

        if(!$permission)
            return redirect()->back();
        
        $permission->delete();

        return redirect()->route('permissions.index');
    }

    public function search (Request $request){
        $filters = $request->except('_token');
        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', ['permissions' => $permissions, 'filters' => $filters]);
    }

    public function edit ($id){
        $permission = $this->repository->find($id);

        if(!$permission)
            return redirect()->back();

        return view('admin.pages.permissions.edit', ['permission' => $permission]);
    }

    public function update (StoreUpdatePermission $request, $id){
        $permission = $this->repository->find($id);

        if(!$permission)
            return redirect()->back();

        $permission->update($request->all());

        return redirect()->route('permissions.index');
    }
}

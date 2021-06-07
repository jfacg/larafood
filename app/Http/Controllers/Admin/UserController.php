<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(User $user){
        $this->repository = $user; 
    }

    public function index (){
        $users = $this->repository->tenantUser()->paginate();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']); // encrypt password

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    public function show ($id){
        $user = $this->repository->tenantUser()->find($id);

        if(!$user)
            return redirect()->back();

        return view('admin.pages.users.show', ['user' => $user]);
    }

    public function destroy ($id){
        $user = $this->repository->tenantUser()->find($id);

        if(!$user)
            return redirect()->back();
        
        $user->delete();

        return redirect()->route('users.index');
    }

    public function search (Request $request){
        $filters = $request->except('_token');
        $users = $this->repository->where(function($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                $query->orWhere('email', $request->filter);
            }
        })
        ->tenantUser()
        ->paginate();

        return view('admin.pages.users.index', compact('users', 'filters'));
    }

    public function edit ($id){
        $user = $this->repository->tenantUser()->find($id);

        if(!$user)
            return redirect()->back();

        return view('admin.pages.users.edit', ['user' => $user]);
    }

    public function update (StoreUpdateuser $request, $id){
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }
}

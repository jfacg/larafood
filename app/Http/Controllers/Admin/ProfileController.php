<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;
use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(Profile $profile){
        $this->repository = $profile; 
    }

    public function index (){
        $profiles = $this->repository->latest()->paginate();
        return view('admin.pages.profiles.index', ['profiles' => $profiles]);
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(StoreUpdateProfile $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('profiles.index');
    }

    public function show ($id){
        $profile = $this->repository->find($id);

        if(!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.show', ['profile' => $profile]);
    }

    public function destroy ($id){
        $profile = $this->repository->find($id);

        if(!$profile)
            return redirect()->back();
        
        $profile->delete();

        return redirect()->route('profiles.index');
    }

    public function search (Request $request){
        $filters = $request->except('_token');
        $profiles = $this->repository->search($request->filter);

        return view('admin.pages.profiles.index', ['profiles' => $profiles, 'filters' => $filters]);
    }

    public function edit ($id){
        $profile = $this->repository->find($id);

        if(!$profile)
            return redirect()->back();

        return view('admin.pages.profiles.edit', ['profile' => $profile]);
    }

    public function update (StoreUpdateProfile $request, $id){
        $profile = $this->repository->find($id);

        if(!$profile)
            return redirect()->back();

        $profile->update($request->all());

        return redirect()->route('profiles.index');
    }
}

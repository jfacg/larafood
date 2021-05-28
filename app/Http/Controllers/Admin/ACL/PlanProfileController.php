<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $profile, $plan;

    public function __construct(Profile $profile, Plan $plan){
        $this->plan = $plan; 
        $this->profile = $profile; 
    }

    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();
        
        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans'));
    }

    public function plansAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();
        

        $filters = $request->except('_token');

        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('profile', 'plans', 'filters'));
    }
    
    public function attachPlansProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();
        
        if (!$request->plans || count($request->plans) == 0) {
            return redirect()
                    ->back()
                    ->with('info', 'Escolha pelo menos uma permissão');
        }

        $profile->plans()->attach($request->plans);

        return redirect()->route('profiles.plans', $idProfile);
    }

    public function detachPlansProfile($idProfile, $idPlan)
    {
        $profile = $this->profile->find($idProfile);
        $plan = $this->plan->find($idPlan);

        if(!$profile || !$plan)
            return redirect()->back();

        $profile->plans()->detach($plan);

        return redirect()->route('profiles.plans', $idProfile);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilePlanController extends Controller
{
    protected $profile, $plan;

    public function __construct(Profile $profile, Plan $plan)
    {
        $this->profile = $profile;
        $this->plan = $plan;
    }


    public function plans($idProfile){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();
        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.plans', compact(['profile', 'plans']));
    }

    public function plansAvaliable(Request $request, $idProfile){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();

        $filters = $request->except('_token');

        $plans = $profile->plansAvaliable($request->filter);
        return view('admin.pages.profiles.plans.avaliable', compact(['profile', 'plans', 'filters']));
    }

    public function attachPlansProfile(Request $request, $idProfile){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);

        if(!$profile)
            return redirect()->back();

        if(!is_array($request->plans) || count($request->plans) < 1)
            return redirect()->back()->with('error', 'Escolha pelo menos uma validação');

        $profile->plans()->attach($request->plans);

        return redirect()->route('profiles.plans.index', $idProfile);
    }

    public function detachPlansProfile($idProfile, $idPlan){
        /** @var Profile $profile */
        $profile = $this->profile->find($idProfile);
        $permission = $this->plan->find($idPlan);
        if(!$profile || !$permission)
            return redirect()->back();

        $profile->plans()->detach($permission);
        return redirect()->route('profiles.plans.index', $idProfile);

    }

    public function plansProf($idPlan){
        /** @var Plan $plan */
        $plan = $this->plan->find($idPlan);

        if(!$plan)
            return redirect()->back();
        $profiles = $plan->profiles()->paginate();

        return view('admin.pages.plans.profiles.profiles', compact(['profiles', 'plan']));
    }
}

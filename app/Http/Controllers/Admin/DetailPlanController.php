<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    private $repository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan){
        $plan = $this->plan->where('url', $urlPlan)->first();

        if(!$plan)
            return redirect()->back();

        $detais = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $detais
        ]);
    }

    public function create($urlPlan){
        $plan = $this->plan->where('url', $urlPlan)->first();

        if(!$plan)
            return redirect()->back();

        return view('admin.pages.plans.details.create', compact('plan'));
    }

    public function store($urlPlan, StoreUpdateDetailPlan $request){

//        dd($urlPlan,$request->all());

        $plan = $this->plan->where('url', $urlPlan)->first();

        if(!$plan)
            return redirect()->back();

//        $data = $request->all();
//        $data['plan_id'] = $plan->id;
//        $this->repository->create($data);
//        $this->repository->create($request->all());

        $plan->details()->create($request->all());
        return redirect()->route('details.plan.index', $plan->url);
    }

    public function edit($urlPlan, $idDetail){

        $plan = $this->plan->where('url', $urlPlan)->first();
        if(!$plan)
            return redirect()->back();

        $detail = $this->repository->find($idDetail);
        if(!$detail)
            return redirect()->back();

        return view('admin.pages.plans.details.edit', compact(['plan','detail'])
        );
    }

    public function update($urlPlan, $idDetail,StoreUpdateDetailPlan $request){

        $plan = $this->plan->where('url', $urlPlan)->first();
        if(!$plan)
            return redirect()->back();

        $detail = $this->repository->find($idDetail);
        if(!$detail)
            return redirect()->back();

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }

    public function show($urlPlan, $idDetail){
        $plan = $this->plan->where('url', $urlPlan)->first();
        if(!$plan)
            return redirect()->back();

        $detail = $this->repository->find($idDetail);
        if(!$detail)
            return redirect()->back();

        return view('admin.pages.plans.details.show', compact(['plan','detail']));
    }
    public function destroy($urlPlan, $idDetail){
        $plan = $this->plan->where('url', $urlPlan)->first();
        if(!$plan)
            return redirect()->back();

        $detail = $this->repository->find($idDetail);
        if(!$detail)
            return redirect()->back();

        $detail->delete();

        return redirect()
                    ->route('details.plan.index', $plan->url)
                    ->with('message-success', 'Registro excluído com sucesso.');
    }

}

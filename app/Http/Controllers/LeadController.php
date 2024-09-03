<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreRequest;
use App\Http\Requests\Lead\UpdateRequest;
use App\Http\Resources\LeadResource;
use App\Interfaces\LeadRepositoryInterface;
use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadController extends Controller
{
    private LeadRepositoryInterface $leadRepositoryInterface;

    public function __construct(LeadRepositoryInterface $leadRepositoryInterface)
    {
        $this->leadRepositoryInterface = $leadRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leads = $this->leadRepositoryInterface->index();

        return Inertia::render('Lead/Dashboard', [
            'leads' => LeadResource::collection($leads),
            'countByStatuses' => $this->leadRepositoryInterface->getCountByStatuses(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $this->leadRepositoryInterface->store($request->all());

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        return Inertia::render('Lead/Edit', [
            'lead' => new LeadResource($lead)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Lead $lead)
    {
        $this->leadRepositoryInterface->update($request->all(), $lead);
        return back()->with(['message' => 'Лид успешно обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $this->leadRepositoryInterface->delete($lead);
        return back()->with(['message' => 'Лид успешно удален']);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->leadRepositoryInterface->updateStatus($request->status, $id);
        return back()->with(['message' => 'Статус лида успешно обновлен']);
    }
}

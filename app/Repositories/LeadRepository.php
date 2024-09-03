<?php

namespace App\Repositories;

use App\Interfaces\LeadRepositoryInterface;
use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\DB;

class LeadRepository implements LeadRepositoryInterface
{
    public function index()
    {
        return Lead::with('status')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);
    }

    public function store(array $data)
    {
        $lead = new Lead();

        $lead->first_name = $data['firstName'];
        $lead->last_name = $data['lastName'];
        $lead->email = $data['email'];
        $lead->phone = $data['phone'];
        $lead->message = $data['message'];
        $lead->save();

        return $lead;

    }

    public function update(array $data, Lead $lead)
    {
        $lead->first_name = $data['firstName'];
        $lead->last_name = $data['lastName'];
        $lead->email = $data['email'];
        $lead->phone = $data['phone'];
        $lead->status_id = LeadStatus::where('title', $data['status'])->first()->id;
        $lead->message = $data['message'];
        $lead->save();

        return $lead;
    }

    public function delete(Lead $lead)
    {
        $lead->delete();
    }

    public function getCountByStatuses()
    {
        $statuses = LeadStatus::all();

        $leadsCountByStatus = Lead::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->pluck('total', 'status_id');

        $result = $statuses->mapWithKeys(function ($status) use ($leadsCountByStatus) {
            return [$status->title => $leadsCountByStatus->get($status->id, 0)];
        });

        $result['всего'] = Lead::count();
        return $result;
    }

    public function updateStatus(string $status, int $id)
    {
        $status = LeadStatus::where('title', $status)->first();
        if ($status)
            Lead::where('id', $id)->update(['status_id' => $status->id]);
    }
}

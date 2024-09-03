<?php

namespace App\Interfaces;

use App\Models\Lead;

interface LeadRepositoryInterface
{
    public function index();

    public function store(array $data);

    public function update(array $data, Lead $lead);

    public function delete(Lead $lead);

    public function getCountByStatuses();

    public function updateStatus(string $status, int $id);
}

<?php

namespace App\Repositories;

use App\Models\Pricing;
use illuminate\Support\Collection;

interface PricingRepositoryInterface
{
    public function findById(int $id): ?Pricing;

    public function getAll(): Collection;
}

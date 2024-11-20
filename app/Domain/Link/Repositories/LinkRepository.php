<?php

namespace App\Domain\Link\Repositories;
use App\Models\Link;

class LinkRepository
{
    public function create(array $data): Link
    {
        return Link::create($data);
    }

    public function findByShortCode(string $shortCode): ?Link
    {
        return Link::where('short_code', $shortCode)->first();
    }
    public function getAll(): array
    {
        return Link::latest()->get()->toArray();
    }
}

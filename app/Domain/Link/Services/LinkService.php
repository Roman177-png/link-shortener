<?php

namespace App\Domain\Link\Services;

use App\Domain\Link\Repositories\LinkRepository;
use App\Models\Link;

class LinkService
{
    private LinkRepository $repository;
    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }
    public function shortenUrl(string $originalUrl): array
    {
        $shortCode = $this->generateUniqueShortCode();

        $link = $this->repository->create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
        ]);
        return [
            'original_url' => $link->original_url,
            'short_url' => url("/{$link->short_code}"),
        ];
    }
    private function generateUniqueShortCode(): string
    {
        do {
            $shortCode = Link::generateShortCode();
        } while ($this->repository->findByShortCode($shortCode));

        return $shortCode;
    }
    public function findLinkByShortCode(string $shortCode): ?Link
    {
        return $this->repository->findByShortCode($shortCode);
    }
    public function getAllLinks(): array
    {
        return $this->repository->getAll();
    }
}

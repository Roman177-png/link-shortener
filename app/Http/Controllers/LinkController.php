<?php

namespace App\Http\Controllers;

use App\Domain\Link\Services\LinkService;
use App\Http\Requests\ShortenUrlRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private LinkService $linkService;
    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }
    public function shorten(ShortenUrlRequest $request)
    {
        return response()->json($this->linkService->shortenUrl($request->validated()['original_url']));
    }
    public function redirect(string $shortCode)
    {
        $link = $this->linkService->findLinkByShortCode($shortCode);

        if (!$link) {
            throw new ModelNotFoundException("Link with shortcode {$shortCode} not found.");
        }

        return redirect($link->original_url);
    }
    public function getAllLinks()
    {
        $links = $this->linkService->getAllLinks();
        return response()->json($links);
    }
    public function delete(string $shortCode)
    {
        $link = $this->linkService->findLinkByShortCode($shortCode);

        if (!$link) {
            throw new ModelNotFoundException("Link with shortcode {$shortCode} not found.");
        }

        $link->delete();
        return response()->noContent();
    }

}

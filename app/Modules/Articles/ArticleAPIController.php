<?php
namespace App\Modules\Articles;

use App\Core\Controller;
use App\Security\Auth;

class ArticleAPIController extends Controller
{
    public function list(): void
    {
        $articles = (new ArticleService())->getAllBySite(Auth::siteId());
        // Return as JSON array of simplified objects
        $result = array_map(fn($a) => [
            'id' => $a->id,
            'title' => $a->title,
            'status' => $a->status,
            'slug' => $a->slug,
            'published_at' => $a->published_at,
        ], $articles);
        $this->json($result);
    }

    public function show(int $id): void
    {
        $article = Article::find($id);
        if (!$article) {
            $this->json(['error' => 'Not found'], 404);
        }
        $this->json($article);
    }
}
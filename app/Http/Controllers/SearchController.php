<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $category = $request->query('category'); // html, css, javascript, nodejs
        $q = $request->query('q');

        $types = [
            'html' => ['*.html', '*.blade.php'],
            'css'  => ['*.css', '*.scss', '*.sass'],
            'javascript' => ['*.js', '*.mjs', '*.ts', '*.jsx', '*.tsx'],
            'nodejs' => ['package.json', '*.js', '*.mjs'],
        ];

        if (! $category || ! isset($types[$category])) {
            return response()->json(['error' => 'Invalid category. Use: html, css, javascript, nodejs'], 400);
        }

        $patterns = $types[$category];

        $finder = new Finder();
        $finder->files()
               ->in([
                   base_path('resources'),
                   base_path('routes'),
                   base_path('app'),
                   base_path('public'),
                   base_path('database'),
               ])
               ->exclude(['vendor', 'node_modules', 'storage', '.git', 'bootstrap/cache'])
               ->ignoreUnreadableDirs()
               ->name($patterns)
               ->sortByName();

        $results = [];
        foreach ($finder as $file) {
            // optional filename filter
            if ($q && stripos($file->getFilename(), $q) === false) {
                continue;
            }

            $relative = Str::replaceFirst(base_path() . DIRECTORY_SEPARATOR, '', $file->getRealPath());
            $results[] = $relative;
        }

        return response()->json([
            'category' => $category,
            'query' => $q,
            'count' => count($results),
            'results' => $results,
        ]);
    }
}



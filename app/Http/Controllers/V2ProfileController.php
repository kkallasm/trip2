<?php

namespace App\Http\Controllers;

use App\User;

class V2ProfileController extends Controller
{
    public function show($id)
    {
        $types = ['forum', 'travelmate', 'buysell'];

        $user = User::findOrFail($id);

        $comments = $user->comments()
            ->whereStatus(1)
            ->whereHas('content', function ($query) use ($types) {
                $query->whereIn('type', $types);
            })
            ->latest()
            ->take(10)
            ->get();

        return view('v2.layouts.2col')

            ->with('header', region('ProfileMasthead', $user))

            ->with('content', collect()
                ->push(component('Block')->with('content', collect(['ProfilePhoto'])))
                ->merge($comments->map(function ($comment) {
                    return region('Comment', $comment);
                }))
            )

            ->with('sidebar', collect()
                ->push(component('Block')->with('content', collect(['ProfileBlog'])))
            )

            ->with('footer', region('Footer'));
    }
}
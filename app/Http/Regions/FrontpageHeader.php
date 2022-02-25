<?php

namespace App\Http\Regions;

class FrontpageHeader
{
    public function render($destinations)
    {
        return component('FrontpageHeader')
            ->with('background', '/photos/header3.jpg')
            ->with(
                'navbar',
                component('Navbar')
                    ->is('white')
                    ->with('search', component('NavbarSearch')->is('white'))
                    ->with(
                        'logo',
                        component('Icon')
                            ->with('icon', 'trip-ukraine')
                            ->with('width', 200)
                            ->with('height', 150)
                    )
                    ->with('navbar_desktop', region('NavbarDesktop', 'white'))
                    ->with('navbar_mobile', region('NavbarMobile', 'white'))
            )
            ->with(
                'search',
                component('FrontpageSearch')
                    ->with('height', 5)
                    ->with('route', route('destination.showSlug', [0]))
                    ->with('placeholder', trans('frontpage.index.search.title'))
                    ->with('options', $destinations)
            );
    }
}

@include('layouts.Two.Two', collect()
    ->put('header', region('StaticHeader', collect()
        ->push(component('Title')
            ->is('red')
            ->is('large')
            ->with('title', trans('error.500.title'))
        )
    ))
    ->put('content', collect()
        ->push(component('Body')
            ->is('responsive')
            ->with('body', trans('error.500.body'))
        )
        ->push('&nbsp;')
    )
    ->put('footer', region('FooterLight'))
)
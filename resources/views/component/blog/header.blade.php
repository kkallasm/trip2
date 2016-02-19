<div class="c-blog-header {{ $modifiers or '' }}">

    @if (isset($logo))

    <div class="c-blog-header__logo">

        <a href="/" class="c-blog-header__logo-link">

            @include('component.logo', [
                'modifiers' => 'm-dark'
            ])
        </a>
    </div>

    @endif

    @if(\Auth::user() && ! \Auth::user()->hasRole('admin'))

    <div class="c-blog-header__user">

        @if(isset($modifiers) && $modifiers == 'm-alternative')

            @include('component.navbar.user', [
                'modifiers' => 'm-green m-blog',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])

        @else

            @include('component.navbar.user', [
                'modifiers' => 'm-green m-alternative',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])

        @endif

    </div>

    @elseif(\Auth::user() && \Auth::user()->hasRole('admin'))

    <div class="c-blog-header__user">

        @if(isset($modifiers) && $modifiers == 'm-alternative')

            @include('component.navbar.user', [
                'modifiers' => 'm-purple m-blog',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.admin'),
                        'route' => route('content.index', ['internal'])
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])

        @else

            @include('component.navbar.user', [
                'modifiers' => 'm-purple m-alternative',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.admin'),
                        'route' => route('content.index', ['internal'])
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])
        @endif
    </div>

    @endif

    <a href="#" class="c-header__nav-trigger js-header__nav-trigger">
        <span></span>
        <span></span>
        <span></span>
    </a>

    <div class="c-blog-header__nav js-header__nav">

        @if(isset($modifiers) && $modifiers == 'm-alternative')

            @include('component.blog.navbar',[
                'modifiers' => 'm-green m-blog'
            ])

        @else

            @include('component.blog.navbar',[
                'modifiers' => 'm-green m-alternative'
            ])

        @endif

    </div>

    <a href="#" class="c-blog-header__search-trigger js-header__search-trigger">
        @include('component.svg.sprite', [
            'name' => 'icon-search'
        ])
    </a>

    <div class="c-blog-header__search js-header__search">

        @if(isset($modifiers) && $modifiers == 'm-alternative')

            @include('component.header.search',[
                'modifiers' => 'm-small m-red m-blog',
                'placeholder' => ''
            ])
        @else

            @include('component.header.search',[
                'modifiers' => 'm-small m-red m-alternative',
                'placeholder' => ''
            ])
        @endif
    </div>

    @if (isset($back))

    <a href="{{ $back['route'] }}" class="c-blog-header__back">{{ $back['title'] }}</a>

    @endif



{{--     <div class="c-blog-header__actions">

        <a href="#" class="c-blog-header__action m-border">Alusta blogimist</a>

        @if(\Auth::user() && ! \Auth::user()->hasRole('admin'))

        <div class="c-blog-header__user">

            @include('component.navbar.user', [
                'modifiers' => 'm-green',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])
        </div>

        @elseif(\Auth::user() && \Auth::user()->hasRole('admin'))

        <div class="c-blog-header__user">

            @include('component.navbar.user', [
                'modifiers' => 'm-purple',
                'profile' => [
                    'image' => \Auth::user()->imagePreset(),
                    'title' => \Auth::user()->name,
                    'route' => route('user.show', [\Auth::user()]),
                    'badge' => \Auth::user()->unreadMessagesCount(),
                    'letter' => [
                        'modifiers' => 'm-green m-tiny',
                        'text' => 'W'
                    ]
                ],
                'children' => [
                    [
                        'title' => trans('menu.user.profile'),
                        'route' => route('user.show', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.user.message'),
                        'route' => route('message.index', [\Auth::user()]),
                        'badge' => \Auth::user()->unreadMessagesCount()
                    ],
                    [
                        'title' => trans('menu.user.edit.profile'),
                        'route' => route('user.edit', [\Auth::user()]),
                    ],
                    [
                        'title' => trans('menu.auth.admin'),
                        'route' => route('content.index', ['internal'])
                    ],
                    [
                        'title' => trans('menu.auth.logout'),
                        'route' => route('login.logout'),
                    ]
                ]
            ])
        </div>

        @else

        <a href="#" class="c-blog-header__action">Minu Trip.ee</a>

        @endif

    </div> --}}
</div>
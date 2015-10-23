{{--

title: Card

code: |

    @include('component.card', [
        'image' => \App\Image::getRandom(),
        'route' => '',
        'title' => 'Here is title',
        'text' => 'Here is subtitle',
        'options' => $modifiers,
    ])

modifiers:

- m-red
- m-blue
- m-green
- m-orange
- m-yellow
- m-purple
- m-small

--}}

<div class="c-card {{ $modifiers or '' }}">

    <div class="c-card__bg" style="background-image: url({{ $image }});"></div>

    @if (isset($route))

    <a href="{{ $route }}" class="c-card__link">

    @endif

    <div class="c-card__content">

        @if (isset($title))

        <h3 class="c-card__title">{{ $title }}</h3>

        @endif

        @if (isset($text))

        <p class="c-card__text">{{ $text }}</p>

        @endif

    </div>

    @if (isset($route))

    </a>

    @endif

</div>
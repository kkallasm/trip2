{{--

title: Profile

code: |

    @include('component.profile', [
        'modifiers' => $modifiers,
        'route' => '#',
        'title' => 'Name Lastname',
        'age' => 22,
        'image' => \App\Image::getRandom(),
        'interests' => 'Itaalia'
    ])

modifiers:

- m-small
- m-mini
- m-micro

--}}

<div class="c-profile {{ $modifiers or '' }}">

    <div class="c-profile__image-wrap">
        <img src="{{ $image }}" alt="" class="c-profile__image">

        @if (isset($badge))

        <div class="c-profile__badge">

			@include('component.badge', [
				'modifiers' => $badge['modifiers'],
				'count' => $badge['count'],
            ])

        </div>

		@endif

    </div>

    @if (isset($title))

    <div class="c-profile__info">

        <h3 class="c-profile__title">
        	<a href="{{ $route }}" class="c-profile__title-link">{{ $title }}</a>
			@if (isset($age))
				({{ $age }})
			@endif
        </h3>

        @if (isset($interests))

        <p class="c-profile__interests">{{ $interests }}</p>

        @endif
    </div>

     @endif
</div>
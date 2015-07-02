<div class="row">

    @foreach ($contents as $content)

        <div class="col-sm-4">

            <a href="/content/{{ $content->id }}">

                @include('component.card', [
                    'image' => $content->imagePath(),
                    'title' => null
                ])

            </a>

        </div>

    @endforeach

</div>
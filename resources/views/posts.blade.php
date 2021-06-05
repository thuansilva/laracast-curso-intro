<x-layout>

    @foreach ($posts as $post)
    <article class="{{$loop ->even ? 'foobar': ''}}">
        <a href="/post/{{$post->slug}}">
        {{$post->title}}
        </a>
        <div>
            <?= $post->body ?>
        </div>
    </article>
    @endforeach

</x-layout>

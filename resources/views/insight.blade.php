<x-guest-layout>
  <!-- Search View -->
  <h1 class="mb-3 text-center">{{ $title }}</h1>
  <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <form action="/insight">
        @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        @if (request('author'))
          <input type="hidden" name="author" value="{{ request('author') }}">
        @endif
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
          <button class="btn btn-danger" type="submit">Search</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Hero View -->
  @if ($posts->count())
    <div class="hero min-h-fit" style="background-image: url(https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }});">
      <div class="hero-overlay bg-opacity-60"></div>
      <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
          <h1 class="mb-5 text-5xl font-bold">
            <a href="/insight/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a>
            <div class="badge badge-outline">
              <a href="/insight?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
            </div>
          </h1>
          <small>
            <a href="/insight?author={{ $posts[0]->author->email }}">{{ $posts[0]->author->name }}</a>
            • {{ $posts[0]->created_at->diffForHumans() }}
          </small>
          <p class="mb-5">{{ $posts[0]->excerpt }}</p>
          <a href="/article/{{ $posts[0]->slug }}" class="btn">Read More</a>
        </div>
      </div>
    </div>
  
    <!-- List Article -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      @foreach ($posts->skip(1) as $post)
        <div class="card w-80 bg-base-100 shadow-xl">
          <figure><img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" /></figure>
          <div class="card-body">
            <h2 class="card-title">
              <a href="/insight/{{ $post->slug }}">{{ $post->title }}</a>
            </h2>
            <div class="badge badge-outline">
              <a href="/insight?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
            </div>
            <small>
              <a href="/insight?author={{ $post->author->email }}">{{ $post->author->name }}</a>
              • {{ $post->created_at->diffForHumans() }}
            </small>
            <p>{{ $post->excerpt }}</p>
            <div class="card-actions justify-end">
              <a href="/article/{{ $post->slug }}" class="btn">Read More</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Not Found -->
  @else
    <p class="text-center fs-4">No post found.</p>
  @endif

  <div class="d-flex justify-content-end">
    {{ $posts->links() }}
  </div>
</x-guest-layout>
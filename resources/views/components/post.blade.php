@props(['post' => $post])

<div class="mb-4">
    <a href="{{ route('users.posts', $post -> user) }}" class="font-bold">{{$post->user->name}}</a> <span class="text-grey-600 txt-sm"> {{$post->created_at->diffForHumans()}}</span>
    <p class="mb-2">{{$post->body}}</p>

                                    

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500 mb-2 mr-1">Delete</button>
        </form>
    @endcan
                                    
                                

    <div class="flex items-center">
        @auth

            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-blue-500 mb-2 mr-1">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500 mb-2 mr-1">Unlike</button>
                </form>
            @endif
                                            
        @endauth

        <span class="mb-2">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>

    </div>
</div>
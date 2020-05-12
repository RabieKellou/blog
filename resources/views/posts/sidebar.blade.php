  {{-- Blade component --}}
  <x-card title="Most Commented Posts">
    @forelse ($mostCommented as $post)
        <li class="list-group-item">
            <a href="{{ route('posts.show',['post'=>$post->id])}}">{{ $post->title}}</a></h2>
            <p>
                <span class="badge badge-primary">{{ $post->comments_count . ' comment(s)' }}</span>
            </p>
        </li>
        @empty
        <li>most commented posts</li>

    @endforelse
</x-card>
<x-card
    title="Most active users"
    text="a list of active users"
    :items="collect($mostActiveUsers)->pluck('name')">
</x-card>
<x-card
    title="Most Active Users in last month"
    text="a list of active users in last month"
    :items="collect($mostActiveUsersInLastMonth)->pluck('name')">
</x-card>

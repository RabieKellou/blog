@auth
<h5>Add a comment</h5>
    <form method="POST" action="{{ route('posts.comments.store',['post' => $id]) }}">
        @csrf
        <textarea class="form-content my-3" name="content" id="content" rows="3"></textarea>
        <x-errors my-class='warning'></x-errors>
        <button class="btn btn-block btn-primary" type="submit">Add comment</button>
    </form>
    @else
    <a href="" class="btn btn-success btn-sm">Sign In</a> to post a comment
@endauth

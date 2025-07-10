<!DOCTYPE html>
<html lang="en">
<head>
<style>
    #comment-section {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        font-family: 'Segoe UI', sans-serif;
    }

    .comment-box {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .reply-box {
        background: #f8f9fa;
        border-left: 3px solid #007bff;
        margin-top: 10px;
        padding: 10px 15px;
        border-radius: 5px;
        margin-left: 20px;
    }

    .comment-header {
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }

    .comment-body {
        color: #555;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .comment-form textarea,
    .reply-form textarea {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px;
        font-size: 14px;
        margin-top: 6px;
        resize: vertical;
    }

    .comment-form button,
    .reply-form button {
        margin-top: 6px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
    }

    .comment-form button:hover,
    .reply-form button:hover {
        background-color: #0056b3;
    }

    .comment-form,
    .reply-form {
        margin-top: 10px;
    }
</style>

</head>
<body>
 



<div id="comment-section">
    @foreach($comments as $comment)
        <div class="comment-box">
            <div class="comment-header">{{ $comment->user->name }}</div>
            <div class="comment-body">{{ $comment->body }}</div>

            @auth
            <!-- Reply form -->
            <form class="reply-form" data-parent="{{ $comment->id }}">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="body" rows="2" placeholder="Write a reply..." required></textarea>
                <button type="submit">Reply</button>
            </form>
            @endauth

            @guest
            <p><small><a href="{{ route('login') }}">Login to reply</a></small></p>
            @endguest

            <!-- Show replies -->
            @foreach($comment->replies as $reply)
                <div class="reply-box">
                    <div class="comment-header">{{ $reply->user->name }}</div>
                    <div class="comment-body">{{ $reply->body }}</div>
                </div>
            @endforeach
        </div>
    @endforeach

    <!-- Main Comment Form -->
    @auth
    <form id="main-comment-form" class="comment-form">
        @csrf
        <textarea name="body" rows="3" placeholder="Write a comment..." required></textarea>
        <button type="submit">Comment</button>
    </form>
    @endauth

    @guest
    <p><small><a href="{{ route('login') }}">Login to comment</a></small></p>
    @endguest
</div>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Main Comment
    $('#main-comment-form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: "{{ route('comments.store') }}",
            type: "POST",
            data: form.serialize(),
            success: function () {
                alert('Comment added!');
                location.reload(); // optional: reload or fetch dynamically
            },
            error: function () {
                alert('Error posting comment');
            }
        });
    });

    // Reply
    $('.reply-form').submit(function(e) {
        e.preventDefault();
        let form = $(this);
        $.ajax({
            url: "{{ route('comments.store') }}",
            type: "POST",
            data: form.serialize(),
            success: function () {
                alert('Reply added!');
                location.reload(); // or re-fetch specific block
            },
            error: function () {
                alert('Error posting reply');
            }
        });
    });
</script>

</body>
</html>
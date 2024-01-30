

@extends('dashboard.public.master')


@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $post->user->img) }}" class="img-thumbnail rounded-circle mr-3" width="50" height="50" alt="User Image">
                        <div>
                            <h6>{{ $post->user->fullname }}</h6>
                            <p class="text-muted mb-0">{{ $post->created_at }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                    <div class="text-center">

                        <img @if ($post->type == 'image')
                            src="{{ asset('storage/' . $post->image_path ) }}" controls alt="User Image"
                        @endif : >


                        @if ($post->type == 'file')
                            <div>
                                <div>
                                    <a href="{{ asset('storage/' . $post->file_path) }}" target="_blank">
                                        <div class="file-icon">
                                                <i class="fa fa-file-pdf-o"></i> <!-- Use an appropriate font-awesome class for the PDF icon -->
                                                <p>{{ basename($post->file_path) }}</p> <!-- Display the file name -->
                                        </div>
                                    </a>
                                </div>
                                {{-- <iframe src="{{ asset('storage/' . $post->file_path) }}" width="100%" height="100%">
                                    This browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('storage/' . $post->file_path) }}">Download PDF</a>
                                </iframe>
                                <object data="{{ asset('storage/' . $post->file_path) }}" type="application/pdf">
                                    <div>No online PDF viewer installed</div>
                                </object> --}}
                            </div>

                        @endif




                        @if ($post->type == 'link')
                            <a href="{{ $post->link }}" target="_blank">Voir Lien</a>
                        @endif



                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="#" class="text-primary comment-toggle"><i class="fas fa-comment-alt"></i> Comments ({{ $post->comments->count() }})</a>
                            <a href="#" class="text-primary like-post" data-post-id="{{ $post->id }}" data-liked="{{ $post->isLiked() }}">
                                <i class="fas fa-heart{{ $post->isLiked() ? '-liked' : '' }}"></i> Likes (<span class="like-count">{{ $post->likes->count() }}</span>)
                            </a>
                        </div>
                        <div>
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->


                <div class="card-footer comments-section " style="display: none;">
                    @foreach($post->comments as $comment)
                        <div class="card-comment">
                            <div class="d-flex align-items-center img-header">
                                <img src="{{ asset('storage/' . $comment->user->img) }}" class="img-thumbnail rounded-circle mr-3" width="50" height="50" alt="User Image">
                                <strong >{{ $comment->user->fullname }}</strong>
                            </div>
                                        <div class="comment ml-5" >
                                            <p> {{ $comment->content }}</p>
                                            <a href="#" class="comment-option" data-comment-id="{{ $comment->id }}">Edit</a>
                                            <a href="#" class="comment-option" data-comment-id="{{ $comment->id }}">Delete</a>

                                        </div>
                        </div>
                    @endforeach


                    <form class="comment-form" data-post-id="{{ $post->id }}">
                        @csrf
                        <input type="text" name="content" class="form-control" placeholder="Add a comment...">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>


                {{-- <div class="card-footer comments-section" style="display: none;">
                    @foreach($post->comments as $comment)
                        <div class="comment">
                            <p><strong>{{ $comment->user->fullname }}</strong>: {{ $comment->content }}</p>
                        </div>
                    @endforeach
                    <form class="comment-form" data-post-id="{{ $post->id }}">
                        @csrf
                        <input type="text" name="content" class="form-control" placeholder="Add a comment...">
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div> --}}

            </div>
        @endforeach
    </div>

    <style>
        .container {
            max-width: 600px;
            padding-top: 100px;  
            
        }

        .card-body img {
            width: 100%;
            height: auto;
            margin: 10px 0;

        }
        .card-body p {
            margin: 10px 0;
            font: 1em sans-serif;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #000;
        }

        .comments-section {
            /* padding: 10px; */
            /* margin: 10px 0; */
            background: #f1f1f1;
            font-size: 14px;
        }
        .comments-section strong {
            font-weight: bold;
            color: #333;

        }

        .card-comment {
            margin-bottom: 10px;
            background-color: gainsboro;
            padding: 10px;
            border-radius: 10px;

        }

        .card-comment img {
            /* margin-top: 10px; */
        }



        .card-header {
            padding: 3px;
            border-bottom: 1px solid #ccc;
        }

        .card-header .d-flex {
            align-items: center;
        }

        .card-header img {
            border-radius: 50%;
        }

        .card-footer {
            padding: 10px;
            background: #f1f1f1;
        }

        .card-footer .d-flex {
            align-items: center;
        }

        .card-footer a {
            margin-right: 10px;
        }

        .comments-section {
            padding: 10px;
        }

        .comment-form {
            display: flex;
            flex-direction: row;
        }

        .comment-form input {
            flex-grow: 2;
            margin-right: 10px;
        }

        .file-icon i {
            font-size: 50px;
            color: #f40101;
        }

        .file-icon p {
            font-size: 15px;
            color: #000;
            margin-left: 10px;
            font-weight: bold;

        }
        .file-icon{
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            display: flex;
            flex-direction: row;
            align-items: center;
            /* justify-content: center; */
            background: #f1f1f1;
        }



    </style>


    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.like-post').on('click', function (e) {
                e.preventDefault();
                const postId = $(this).data('post-id');
                const isLiked = $(this).data('liked');
                const likeCount = $(this).find('.like-count');

                $.ajax({
                    type: 'POST',
                    url: '/post/like',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'post_id': postId,
                    },
                    success: function (data) {
                        if (data.success) {
                            if (isLiked) {
                                $(this).data('liked', false);
                                $(this).find('i').removeClass('liked');
                                likeCount.text(parseInt(likeCount.text()) - 1);
                            } else {
                                $(this).data('liked', true);
                                $(this).find('i').addClass('liked');
                                likeCount.text(parseInt(likeCount.text()) + 1);
                            }
                        }
                    }
                });
            });

            $('.comment-toggle').on('click', function (e) {
                e.preventDefault();
                $(this).closest('.card-footer').next('.comments-section').toggle();
            });


        $('.comment-form').on('submit', function (e) {
            // e.preventDefault();
            const form = $(this);
            const postId = form.data('post-id'); // Get the post ID from the form's data attribute
            const content = form.find('input[name="content"]').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("post.comment") }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'post_id': postId,
                    'content': content,
                },
                success: function (data) {
                    if (data.success) {
                        // You can handle the success response here (e.g., add the comment to the post).
                        const comment = data.comment;
                        const commentHtml = `<div class="comment"><p><strong>${comment.user.fullname}</strong>: ${comment.content}</p></div>`;
                        form.closest('.card').find('.comments-section').append(commentHtml);
                        form.find('input[name="content"]').val(''); // Clear the comment input field
                    }
                }
            });
        });

        });

    </script>

    <script>


                $('.comment-option').on('click', function (e) {
            e.preventDefault();
            const commentId = $(this).data('comment-id');

            // You can now handle the action (Edit or Delete) for the comment with the commentId.

            if ($(this).text() === 'Delete') {
                if (confirm('Are you sure you want to delete this comment?')) {
                    // Send a DELETE request to delete the comment using commentId.
                    $.ajax({
                        type: 'DELETE', // This sends a DELETE request.
                        url: '/comment/delete/' + commentId, // Adjust the URL according to your route.
                        data: {
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (data) {
                            if (data.success) {
                                // Remove the comment from the UI.
                                // $(e.currentTarget).closest('.comment').remove();
                                $(e.currentTarget).closest('.card-comment').remove();

                            }
                        }
                    });
                }
            }

            // Handle the "Edit" action as needed.
        });

    </script>


@endsection

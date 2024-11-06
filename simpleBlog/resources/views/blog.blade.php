<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Blog Detail</title>
        <link href='https://fonts.googleapis.com/css?family=Poppins:300,700' rel='stylesheet' type='text/css'>
        <!-- Style Sheet-->
        <link rel="stylesheet" type="text/css" href="font/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <!-- META TAGS -->
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <style>
            #message {
                width: 100% !important;
                height: 70px !important;
                border-radius: 40px;
                padding-top: 3.5% !important;
                padding-left: 3.5% !important;
                line-height: 1.5;
                resize: none;
            }

            .comments-container {
                max-height: 400px;
                overflow-y: auto;
                padding: 10px;
                border: 0.2px solid #ccc;
                border-radius: 5px;
            }

            .blog-content {
                margin-bottom: 10px;
            }

            .blog-coments-emma {
                margin: 5px 0;
            }

            .title1 {
                font-weight: bold;
            }

            .title3 {
                font-weight: bold
            }

            .post-title a {
                font-size: 1.5rem;
                font-weight: bold;
                color: #333;
                text-decoration: none;
            }

            .post-content {
                margin-top: 15px;
            }

            .blog-social {
                margin-top: 15px;
            }

            .blog-tt .date {
                font-size: 0.9rem;
            }

            .blog-coments h6 {
                font-size: 1.1rem;
                font-weight: bold;
            }
            .blog-coments-emma {
    position: relative;

}
.delete-button, .edit-button {
    position: absolute;
    top: 10px;
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.delete-button {
    right: 40px;
    color: red;
}

.edit-button {
    right: 10px;
    color: blue;
}

.delete-button:hover, .edit-button:hover {
    opacity: 0.7; /* Adds hover effect */
}



        </style>
    </head>
    <body id="bd" class="cms-index-index4 header-style4 prd-detail blog-pagev1 detail cms-simen-home-page-v2 default cmspage">
        <div id="sns_wrapper">


            <!-- BREADCRUMBS -->
            <div id="sns_breadcrumbs" class="wrap">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Open Large Modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">New Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form to submit post -->
        <form action="{{ route('createPost') }}" method="POST">
          @csrf <!-- CSRF Token for Laravel security -->

          <div class="form-group">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <div class="form-group">
            <label for="content" class="col-form-label">Content:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
          </div>

          <!-- Hidden input to pass the authenticated user's ID -->
          <input type="hidden" name="user_id" value="{{ Auth::id() }}">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

                            <!-- Your breadcrumb code goes here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BREADCRUMBS -->

            <!-- CONTENT -->
            <div id="sns_content" class="wrap">
                <div class="container">
                    <div class="row">

                        <div id="sns_main" class="col-md-9 col-main">
                            <div id="sns_mainmidle">
                                <div class="blogs-page">
                                    <div class="postWrapper v1">
                                        @foreach ($posts as $post)
                                            <div class="post-title">
                                                <a>{{ $post->title }}</a>
                                            </div>
                                            <div class="post-content">
                                                <p class="text1">
                                                    {{ $post->content }}
                                                </p>

                                                <div class="blog-social">
                                                    <p class="blog-tt">
                                                        <div class="date">
                                                            <span class="poster">{{ $post->created_at->format('M d, Y') }}</span>
                                                            <div class="post-info">
                                                                <div class="postDetails">Post by : {{ $post->user->name }}</div>
                                                            </div>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="blog-coments">

                                                <h6>{{ $post->comments->count() }} Comment</h6>
                                            </div>
                                            <div class="comments-container" style="max-height: 400px; overflow-y: auto;">
                                                <div class="blog-coments">
                                                    @foreach ($post->comments as $comment)
                                                    <div class="blog-content">
                                                        <div class="blog-coments-emma">
                                                            <div class="title">
                                                                <p>
                                                                    <span class="title1">{{ $comment->user->name }}
                                                                        <!-- Delete Button -->
                                                                        <button class="delete-button">
                                                                            <i class="fa fa-trash"></i> <!-- Trash icon -->
                                                                        </button>
                                                                        <!-- Edit Button -->
                                                                        <button class="edit-button" data-toggle="modal" data-target="#editCommentModal{{ $comment->id }}">
                                                                            <i class="fa fa-edit"></i> <!-- Edit icon -->
                                                                        </button>

                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <div class="depcisen">
                                                                {{ $comment->content }}
                                                            </div>
                                                            <div class="bottom-cm">
                                                                <p>
                                                                    <span class="title3">{{ $comment->created_at->format('M d, Y') }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="form-group">
                                                                            <label for="content">Edit your comment:</label>
                                                                            <textarea class="form-control" id="content" name="content" rows="3" required>{{ $comment->content }}</textarea>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach

                                                </div>
                                            </div>

                                            <h1 class="onenot">Leave a comment</h1>
                                            <form class="smart-green" method="POST" action="{{ route('comments.store', $post->id) }}">
                                                @csrf
                                                <textarea id="message" placeholder="Comment" name="content" rows="2" cols="20"></textarea>
                                                <p class="one3">
                                                    <button class="button" type="Submit" value="Submit">Submit</button>
                                                </p>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- Scripts -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/less.min.js"></script>
        <script src="js/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/sns-extend.js"></script>
        <script src="js/list-grid.js"></script>
        <!-- Include jQuery -->


    </body>
</html>

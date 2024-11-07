<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Blog Detail</title>
        <link href='https://fonts.googleapis.com/css?family=Poppins:300,700' rel='stylesheet' type='text/css'>
        <!-- Style Sheet-->
        <link rel="stylesheet" type="text/css" href="font/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                padding-top: 2% !important;
                padding-left: 2% !important;
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

            p .title3 {
                display: block !important;
                margin-top: 9px;
                color: #5f5f5f;
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

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.post-actions {
    display: flex;
    gap: 5px;
}

.delete-button1, .edit-button1 {
    background: none;
    border: none;
    color: #d10024; /* Red color for delete icon */
    cursor: pointer;
}

/* Styling for the "No comments" message */
.empty {
    text-align: center;
    padding: 20px;
    margin-top: 10px;
    background-color: #f7f7f7;
    border-radius: 8px;
    border: 1px solid #ddd;
    color: #555;
    font-size: 16px;
    font-weight: 500;
}

.empty p {
    margin: 0;
}

        </style>
    </head>
    <body id="bd" class="cms-index-index4 header-style4 prd-detail blog-pagev1 detail cms-simen-home-page-v2 default cmspage">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div id="sns_wrapper">
<!-- Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" >Blog</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav">
          {{-- <li class="active"><a href="#">Home</a></li> --}}
          <li><a href="#">
            @if (Auth::user())
            @if (Auth::user()->role == 'admin')

            <button type="button" style="background-color: transparent; border:0;color:black" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Post</button>
            @endif
            @endif
        </a>
        </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (!Auth::user())

            <li><a href="{{ route('login.form') }}">Login</a></li>
            @endif
          @if (Auth::user())

          <li><a href="{{ route('logout') }}">logout</a></li>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

            <!-- BREADCRUMBS -->
            <div id="sns_breadcrumbs" class="wrap">

                <div class="container">
                    <div class="row">
                        <div class="">


            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myLargeModalLabel">New Post</h4>
                  </div>
                  <div class="modal-body">
                    <!-- Form to submit post -->
                    <form action="{{ route('createPost') }}" method="POST">
                      @csrf <!-- CSRF Token for Laravel security -->

                      <div class="form-group">
                        <label for="title" class="control-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                      </div>

                      <div class="form-group">
                        <label for="content" class="control-label">Content:</label>
                        <textarea class="form-control" id="content" name="content" required></textarea>
                      </div>

                      <!-- Hidden input to pass the authenticated user's ID -->
                      <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

                        <div id="sns_main" class=" col-main">
                            <div id="sns_mainmidle">
                                <div class="blogs-page">
                                    <div class="postWrapper v1">
                                        @if ($posts->count() > 0)


                                        @foreach ($posts as $post)
                                            <div class="post">
                                                <div class="post-header d-flex justify-content-between">
                                                    <div class="post-title">

                                                        <a>{{ $post->title }}</a>
                                                    </div>
                                                    <!-- Edit and Delete icons for the post -->
                                                    <div class="post-actions">
                                                        @if (Auth::user())
                                                        @if (Auth::user()->id == $post->user_id || Auth::user()->role == 'admin')
                                                            <!-- Edit Button -->
                                                            <button class="edit-button1" data-toggle="modal" data-target="#editPostModal{{ $post->id }}">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            <!-- Delete Button -->
                                                            <form action="{{ route('deletePost', $post->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method("DELETE")
                                                                <button type="submit" class="delete-button1">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="post-content">
                                                    <p class="text1">{{ $post->content }}</p>

                                                    <div class="blog-social">
                                                        <div class="date">
                                                            <span class="poster">{{ $post->created_at->format('M d, Y') }}</span>
                                                            <div class="post-info">
                                                                <div class="postDetails">Post by: {{ $post->user->name }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="blog-coments">
                                                    <h6>{{ $post->comments->count() }} Comment</h6>
                                                </div>

                                                <!-- Comments Section -->
                                                <div class="comments-container" style="max-height: 400px; overflow-y: auto;">
                                                    @if ($post->comments->count() > 0)


                                                    @foreach ($post->comments as $comment)
                                                        <div class="blog-content">
                                                            <div class="blog-coments-emma">
                                                                <div class="title">
                                                                    <p>
                                                                        <span class="title1">{{ $comment->user->name }}
                                                                            @if (Auth::user())
                                                                            @if (Auth::user()->id == $comment->user_id || Auth::user()->role == 'admin')
                                                                                <!-- Comment Edit and Delete Buttons -->
                                                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                                                                    @csrf
                                                                                    @method("DELETE")
                                                                                    <button type="submit" class="delete-button">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>
                                                                                </form>

                                                                                <button class="edit-button" data-toggle="modal" data-target="#editCommentModal{{ $comment->id }}">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </button>
                                                                                <!-- Edit Comment Modal -->
                                                                                <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h5 class="modal-title">Edit Comment</h5>
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                    <span aria-hidden="true">&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                                                                                                    @csrf
                                                                                                    @method('PUT')
                                                                                                    <div class="form-group">
                                                                                                        <label>Edit your comment:</label>
                                                                                                        <textarea class="form-control" name="content" rows="3" required>{{ $comment->content }}</textarea>
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
                                                                            @endif
                                                                            @endif
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                                <div class="depcisen">{{ $comment->content }}</div>
                                                                <div class="bottom-cm">
                                                                    <p><span class="title3">{{ $comment->created_at->format('M d, Y') }}</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="empty">
                                                        <p>No comments in this blog</p>
                                                    </div>
                                                                                                        @endif
                                                </div>

                                                <!-- Leave a Comment Form -->
                                                <h1 class="onenot">Leave a comment</h1>
                                                <form class="smart-green" method="POST" action="{{ route('comments.store', $post->id) }}">
                                                    @csrf
                                                    <textarea id="message" placeholder="Comment" name="content" rows="2" cols="20"></textarea>
                                                    <p class="one3">
                                                        <button class="button" type="submit">Submit</button>
                                                    </p>
                                                </form>
                                            </div>

                                            <!-- Edit Post Modal -->
                                            <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Post</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('posts.update', $post->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="title">Edit your post title:</label>
                                                                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="content">Edit your post content:</label>
                                                                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ $post->content }}</textarea>
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
                                        @else
                                        <div class="empty">
                                            <p>No blog available</p>
                                        </div>
                                        @endif
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
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,

            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif

    </body>
</html>

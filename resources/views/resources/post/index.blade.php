<x-app-layout>
    <div class="pagetitle">
        <h1>{{ __('Post') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">{{__('Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{ __('Resource') }}</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message'))
                    <div id="autoDismissAlert" class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Use setTimeout to hide the alert after 5 seconds
                            setTimeout(function() {
                                var alertElement = document.getElementById('autoDismissAlert');
                                if (alertElement) {
                                    // Use Bootstrap's alert 'close' method to hide it
                                    var alert = new bootstrap.Alert(alertElement);
                                    alert.close();
                                }
                            }, 5000); // 5000 milliseconds = 5 seconds
                        });
                    </script>
                @endif
                <div class="card p-5">
                    <div class="text-end">
                        <a href="{{ route('post.create') }}" class="btn btn-primary float-end" ><i class="bi bi-file-earmark-plus-fill me-1 "></i> Add a New Options</a>
                    </div>
                    <div class="card-body">
                        <hr class="my-5">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Post</th>
                                    <th scope="col">Status</th>   
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($posts)
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->subject}}</td>
                                            <td><div class="mb-2">{{$post->post}}</div>
                                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="alert alert-info">
                                                    <button type="button" class="btn-close"></button>
                                                </div>
                                            </td>
                                            <td>{{($post->status == 1 ? 'Published' : 'Unpublished')}}</td>
                                            <td>
                                                <a href="{{ route('post.show', $post) }}" class="btn btn-dark m-1"><i class="bi bi-folder-symlink"></i></a>
                                                <a href="{{ route('post.edit', $post) }}" class="btn btn-success m-1"><i class="bi bi-pencil-square"></i></a>
                                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}" class="btn btn-danger m-1"><i class="bi bi-trash2-fill"></i></button>                   
                                            </td>    
                                              
                                        </tr>
                                        <td colspan="4">
                                                <b><small>Comments</small></b>
                                                
                                            </td>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $post->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this post?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="{{ route('post.destroy', $post) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach   
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
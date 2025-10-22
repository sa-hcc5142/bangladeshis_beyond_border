@extends('layouts.admin')

@section('title', 'Manage Comments')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Comment Management</h1>
        
        @php
            $pendingCount = \App\Models\Comment::pending()->count();
            $approvedCount = \App\Models\Comment::approved()->count();
        @endphp
        
        <div class="text-muted">
            <span class="badge bg-warning">{{ $pendingCount }} Pending</span>
            <span class="badge bg-success">{{ $approvedCount }} Approved</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !request('status') || request('status') == 'pending' ? 'active' : '' }}" 
               href="{{ route('admin.comments.index', ['status' => 'pending']) }}">
                Pending ({{ $pendingCount }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'approved' ? 'active' : '' }}" 
               href="{{ route('admin.comments.index', ['status' => 'approved']) }}">
                Approved ({{ $approvedCount }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'rejected' ? 'active' : '' }}" 
               href="{{ route('admin.comments.index', ['status' => 'rejected']) }}">
                Rejected
            </a>
        </li>
    </ul>

    <!-- Comments Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>
                                    <strong>{{ $comment->user->name }}</strong><br>
                                    <small class="text-muted">{{ $comment->user->email }}</small>
                                    @if($comment->user->isBanned())
                                        <span class="badge bg-danger">Banned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 300px;">
                                        {{ $comment->content }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ class_basename($comment->commentable_type) }}
                                    </span>
                                </td>
                                <td>
                                    @if($comment->is_approved)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($comment->rejected_at)
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(!$comment->is_approved && !$comment->rejected_at)
                                            <!-- Quick Approve -->
                                            <form action="{{ route('admin.comments.quick-approve', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Quick Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <!-- Approve with Answer -->
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#approveModal{{ $comment->id }}">
                                                <i class="fas fa-comment-medical"></i>
                                            </button>

                                            <!-- Reject -->
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejectModal{{ $comment->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif($comment->is_approved && !$comment->answer)
                                            <!-- Add Answer -->
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#answerModal{{ $comment->id }}">
                                                <i class="fas fa-reply"></i> Answer
                                            </button>
                                        @endif

                                        <!-- Delete -->
                                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    @include('admin.comments.partials.modals', ['comment' => $comment])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No comments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush
@endsection

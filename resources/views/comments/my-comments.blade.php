@extends('layouts.app')

@section('title', 'My Questions')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h1 class="h3 mb-4">My Questions & Answers</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(auth()->user()->isBanned())
                <div class="alert alert-danger">
                    <i class="fas fa-ban"></i>
                    <strong>Your account has been banned</strong> due to multiple comment violations. 
                    You cannot submit new questions. Please contact support if you believe this is a mistake.
                </div>
            @endif

            @php
                $warningCount = auth()->user()->warningCount();
            @endphp
            @if($warningCount > 0 && $warningCount < 3)
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    You have <strong>{{ $warningCount }}</strong> warning(s). 
                    {{ 3 - $warningCount }} more warning(s) will result in a ban.
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @forelse($comments as $comment)
                        <div class="border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <span class="badge bg-info mb-2">
                                        {{ class_basename($comment->commentable_type) }}
                                    </span>
                                    @if($comment->is_approved)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($comment->rejected_at)
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning">Pending Review</span>
                                    @endif
                                </div>
                                <small class="text-muted">
                                    {{ $comment->created_at->format('M d, Y') }}
                                </small>
                            </div>

                            <div class="mb-3">
                                <strong>Your Question:</strong>
                                <p class="text-muted mb-0">{{ $comment->content }}</p>
                            </div>

                            @if($comment->answer)
                                <div class="alert alert-light border mb-0">
                                    <strong><i class="fas fa-reply"></i> Answer from {{ $comment->answeredBy->name }}:</strong>
                                    <p class="mb-0 mt-2">{{ $comment->answer }}</p>
                                    <small class="text-muted">
                                        Answered {{ $comment->updated_at->diffForHumans() }}
                                    </small>
                                </div>
                            @elseif($comment->is_approved)
                                <div class="text-muted">
                                    <i class="fas fa-clock"></i> Approved, awaiting answer...
                                </div>
                            @elseif($comment->rejected_at)
                                @php
                                    $warning = $comment->warnings()->where('user_id', auth()->id())->first();
                                @endphp
                                @if($warning)
                                    <div class="alert alert-danger mb-0">
                                        <strong><i class="fas fa-exclamation-circle"></i> Rejection Reason:</strong>
                                        <p class="mb-0 mt-2">{{ $warning->reason }}</p>
                                    </div>
                                @endif
                            @else
                                <div class="text-muted">
                                    <i class="fas fa-hourglass-half"></i> Your question is under review by our moderators.
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p class="mb-0">You haven't asked any questions yet.</p>
                            <p>Visit our country guides or blog posts to ask questions!</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

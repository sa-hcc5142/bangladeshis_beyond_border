{{-- Comment Form Partial - Include in country and blog pages --}}
{{-- Usage: @include('partials.comment-form', ['commentable_type' => 'App\Models\Country', 'commentable_id' => $country->id]) --}}

<div class="card shadow-sm mt-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-question-circle"></i> Ask a Question</h5>
    </div>
    <div class="card-body">
        @guest
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Please <a href="{{ route('login') }}" class="alert-link">login</a> or 
                <a href="{{ route('register') }}" class="alert-link">register</a> to ask a question.
            </div>
        @else
            @if(auth()->user()->isBanned())
                <div class="alert alert-danger">
                    <i class="fas fa-ban"></i>
                    Your account has been banned due to multiple violations. You cannot submit questions.
                </div>
            @else
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
                    <input type="hidden" name="commentable_id" value="{{ $commentable_id }}">

                    <div class="mb-3">
                        <label for="content" class="form-label">Your Question</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" 
                                  name="content" 
                                  rows="4" 
                                  placeholder="Ask your question here (minimum 10 characters)..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            Your question will be reviewed by our moderators before being published.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Submit Question
                    </button>
                    <a href="{{ route('comments.my') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list"></i> My Questions
                    </a>
                </form>
            @endif
        @endguest
    </div>
</div>

{{-- Display Approved Questions & Answers --}}
<div class="card shadow-sm mt-4">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-comments"></i> Community Q&A</h5>
    </div>
    <div class="card-body">
        @php
            $approvedComments = \App\Models\Comment::with(['user', 'answeredBy'])
                ->where('commentable_type', $commentable_type)
                ->where('commentable_id', $commentable_id)
                ->approved()
                ->latest()
                ->take(10)
                ->get();
        @endphp

        @forelse($approvedComments as $comment)
            <div class="border-bottom pb-3 mb-3">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ $comment->user->name }}</strong>
                                <small class="text-muted ms-2">
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                        <p class="mb-2 mt-1">{{ $comment->content }}</p>
                        
                        @if($comment->answer)
                            <div class="alert alert-success mb-0 mt-2">
                                <strong><i class="fas fa-check-circle"></i> Answer:</strong>
                                <p class="mb-0 mt-2">{{ $comment->answer }}</p>
                                <small class="text-muted">
                                    - {{ $comment->answeredBy->name }} ({{ $comment->updated_at->diffForHumans() }})
                                </small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted py-4">
                <i class="fas fa-comment-slash fa-2x mb-2"></i>
                <p class="mb-0">No questions yet. Be the first to ask!</p>
            </div>
        @endforelse

        @if($approvedComments->count() >= 10)
            <div class="text-center mt-3">
                <small class="text-muted">Showing latest 10 questions</small>
            </div>
        @endif
    </div>
</div>

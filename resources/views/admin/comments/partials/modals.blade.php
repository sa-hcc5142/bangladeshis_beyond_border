<!-- Approve with Answer Modal -->
<div class="modal fade" id="approveModal{{ $comment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Approve & Answer Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>User's Question:</strong></label>
                        <p class="text-muted">{{ $comment->content }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="answer{{ $comment->id }}" class="form-label">Your Answer (Optional)</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" 
                                  id="answer{{ $comment->id }}" 
                                  name="answer" 
                                  rows="4" 
                                  placeholder="Provide an answer to the user's question..."></textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">You can approve now and add an answer later if needed.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Approve Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal{{ $comment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.comments.reject', $comment) }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Reject Comment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>Comment:</strong></label>
                        <p class="text-muted">{{ $comment->content }}</p>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> Rejecting this comment will issue a warning to the user. 
                        After 3 warnings, the user will be automatically banned.
                    </div>
                    
                    <div class="mb-3">
                        <label for="reason{{ $comment->id }}" class="form-label">Reason for Rejection *</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" 
                                  id="reason{{ $comment->id }}" 
                                  name="reason" 
                                  rows="3" 
                                  required 
                                  placeholder="Explain why this comment is being rejected..."></textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @php
                        $userWarnings = $comment->user->warningCount();
                    @endphp
                    <div class="mb-0">
                        <small class="text-muted">
                            User currently has <strong>{{ $userWarnings }}</strong> warning(s).
                            @if($userWarnings >= 2)
                                <span class="text-danger">This will be their final warning!</span>
                            @endif
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject & Warn User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Answer Modal (for already approved comments) -->
@if($comment->is_approved && !$comment->answer)
<div class="modal fade" id="answerModal{{ $comment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.comments.answer', $comment) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Answer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><strong>User's Question:</strong></label>
                        <p class="text-muted">{{ $comment->content }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="answerContent{{ $comment->id }}" class="form-label">Your Answer *</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" 
                                  id="answerContent{{ $comment->id }}" 
                                  name="answer" 
                                  rows="5" 
                                  required 
                                  placeholder="Provide a helpful answer..."></textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Answer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

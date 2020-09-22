<div class="modal fade" id="commentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">コメントを編集する({{ Auth::id() }}{{ $comment->body }})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.comments.update', [$comment->portfolio->id, $comment->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">内容</label>
                        <input type="text" class="form-control" name="body" value="{{ $comment->body }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary py-2 px-4 rounded-full col-3" data-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn bg-potfyYellow hover:bg-potfyYellowTitle text-white font-bold py-2 px-4 rounded-full col-3">更新する</button>
                </div>
            </form>
        </div>
    </div>
</div>

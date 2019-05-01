<form action="{{ route('comment.store') }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" name="belong_entity_type" value="{{ $entityType }}">
    <input type="hidden" name="belong_entity_id" value="{{ $entityId }}">

    <div class="input-group">
        <textarea name="content" class="form-control" placeholder="请输入评论内容" rows="3"></textarea>
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="submit" style="width:5em;">发布</button>
        </div>
    </div>
</form>

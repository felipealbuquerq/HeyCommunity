<div class="form-group">
    <label for="input-title" class="col-sm-2 control-label">页面标题</label>
    <div class="col-sm-10">
        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $page->title) }}">
        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group">
    <label for="input-unique_name" class="col-sm-2 control-label">唯一标识</label>
    <div class="col-sm-10">
        <input name="unique_name" type="text" class="form-control" id="input-unique_name" value="{{ old('unique_name', $page->unique_name) }}">
        <div class="text-danger">{{ $errors->first('unique_name') }}</div>
    </div>
</div>

<div class="form-group">
    <label for="input-content" class="col-sm-2 control-label">内容</label>
    <div class="col-sm-10">
        <textarea name="content" class="form-control" id="ckeditor">{{ old('content', $page->content) }}</textarea>
        <div class="text-danger">{{ $errors->first('content') }}</div>

        @include('layouts.ckeditor5.ckeditor-classic')
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default btn-block">提交</button>
    </div>
</div>


<script>
  function formSubmit(event) {
    $('input[name=content]').val(ckeditor.getData());
  }
</script>

<div class="form-group row">
    <div class="col-md-10 offset-md-1">
        <input name="title" type="text" class="form-control text-center" id="input-title" placeholder="文章标题" value="{{ old('title', $column->title) }}">

        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-10 offset-md-1">
        <textarea name="content" class="form-control" id="ckeditor">{{ old('content', $column->content ?: '开始起笔 ..') }}</textarea>

        @include('layouts.ckeditor5.ckeditor-classic')
    </div>
</div>


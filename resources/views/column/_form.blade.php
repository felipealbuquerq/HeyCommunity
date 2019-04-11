<script>
  function formSubmit(event) {
    $('input[name=content]').val(ckeditor.getData());
  }
</script>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-2">
        <input name="title" type="text" class="form-control" id="input-title" placeholder="文章标题" value="{{ old('title', $column->title) }}">

        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-8 offset-sm-2">
        <input type="hidden" name="content">
        <div id="ckeditor" style="border:2px solid #ddd"
             data-html="{{ old('content', $column->content ?: '开始起笔 ...') }}"></div>
        <div class="text-danger">{{ $errors->first('content') }}</div>

        @include('layouts.ckeditor5.ckeditor-classic')
    </div>
</div>


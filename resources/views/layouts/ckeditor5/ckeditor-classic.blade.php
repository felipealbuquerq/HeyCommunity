<script src="{{ asset('assets/ckeditor5/ckeditor-classic/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor5/ckeditor-classic/translations/zh-cn.js') }}"></script>

<style rel="stylesheet">
    .ck-content {
        min-height:300px;
        max-height:400px;
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    .ck-editor .entry {
        max-width: none;
        padding-left: 0;
        padding-right: 0;
    }
</style>

<script>
  ClassicEditor
    .create(document.querySelector('#ckeditor'), {
      language: 'zh-cn',
    }).then(function(editor) {
      $('.ck-editor__main').addClass('entry');
    });


</script>


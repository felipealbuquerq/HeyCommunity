<script src="{{ asset('assets/ckeditor5-balloon-block/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor5-balloon-block/translations/zh-cn.js') }}"></script>

<script>
  BalloonEditor
    .create(document.querySelector('#ckeditor'), {
      language: 'zh-cn'
    }).then(editor => {
      ckeditor = editor;
      ckeditor.setData($('#ckeditor').attr('data-html'));
    }).catch(error => {
        console.error(error);
    });
</script>

<style rel="stylesheet">
    .ck-content {
        min-height: 300px;
        max-height: 400px;
        border: 2px solid #ddd !important;
    }
</style>

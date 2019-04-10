<script src="{{ asset('assets/ckeditor5-document/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor5-document/translations/zh-cn.js') }}"></script>

<script>
  DecoupledEditor
    .create(document.querySelector('#ckeditor'), {
      language: 'zh-cn'
    });
</script>

<style rel="stylesheet">
    .ck-content { min-height:200px; max-height:400px; }.
</style>

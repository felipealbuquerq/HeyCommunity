<script src="{{ asset('assets/ckeditor5-classic/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor5-classic/translations/zh-cn.js') }}"></script>

<script>
  ClassicEditor
    .create(document.querySelector('#ckeditor'), {
      language: 'zh-cn'
    });
</script>

<style rel="stylesheet">
    .ck-content { min-height:200px; max-height:400px; }.
</style>

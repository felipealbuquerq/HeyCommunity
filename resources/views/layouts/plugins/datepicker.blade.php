<link href="{{ asset('bower-assets/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet">
<script src="{{ asset('bower-assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('bower-assets/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js') }}"></script>


<script>
$(function() {
  $('.datepicker').datepicker({
    language: 'zh-CN',
    format: 'yyyy-mm-dd',
  });
})
</script>
@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor-fullscreen.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor-html.css') }}" />

    <script type="text/javascript" src="{{ asset('assets/simditor/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/simditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/simditor-fullscreen.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/beautify-html.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/simditor-html.js') }}"></script>
    <script>
      var editor = new Simditor({
        textarea: $('.simditor-editor'),
        toolbar: ['title', 'bold', 'underline', 'fontScale', 'color', 'alignment', 'indent', 'ol', 'table', 'link', 'image', 'html', 'fullscreen'],
        toolbarFloatOffset: 51,
        pasteImage: true,
        upload: {
          url: '{{ route('upload.simditor-upload-images') }}',
          params: {
            _token: '{{ csrf_token() }}',
          },
          fileKey: 'files',
          connectionCount: 3,
          leaveConfirm: '图片正在上传，你确定要离开？'
        },
      });
    </script>
@endsection

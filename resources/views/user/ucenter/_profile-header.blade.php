<div class="profile-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');">
    <div class="container">
        <div class="container-inner">
            <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}">
            <h3 class="profile-header-user">{{ $user->nickname }}</h3>
            <p class="profile-header-bio">
                {{ $user->bio ?: '暂无签名' }}
            </p>
        </div>

        <div class="row operations">
            <div class="col-sm-6 text-right d-none d-sm-block">
                <button data-toggle="modal" data-target="#modal-upload-avatar" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</button>
                &nbsp;
                <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-picture-o"></i> 更换封面</a>
            </div>

            <div class="col-sm-6 text-left d-none d-sm-block">
                <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-info-circle"></i> 我的主页</a>
                &nbsp;
                <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-id-card-o"></i> 更新资料</a>
            </div>

            <div class="col-12 d-block d-sm-none">
                <div class="btn-group btn-group-sm">
                    <button data-toggle="modal" data-target="#modal-upload-avatar" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</button>
                    <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换头像</a>
                    <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换封面</a>
                    <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary">我的主页</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary">更新资料</a>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.js') }}"></script>

<div class="modal fade" id="modal-upload-avatar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更新头像</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="img-avatar" src="{{ $user->avatar }}" style="width:100%;">
                <style rel="stylesheet">
                    .cropper-container {
                        margin: 0 auto;
                    }
                    .cropper-view-box,
                    .cropper-face {
                        border-radius: 50%;
                    }
                </style>
                <script>
                    function getRoundedCanvas(sourceCanvas) {
                      var canvas = document.createElement('canvas');
                      var context = canvas.getContext('2d');
                      var width = sourceCanvas.width;
                      var height = sourceCanvas.height;

                      canvas.width = width;
                      canvas.height = height;
                      context.imageSmoothingEnabled = true;
                      context.drawImage(sourceCanvas, 0, 0, width, height);
                      context.globalCompositeOperation = 'destination-in';
                      context.beginPath();
                      context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
                      context.fill();
                      return canvas;
                    }


                    var img = $('#img-avatar')[0];
                    console.log(img);

                    var cropper = new Cropper(img, {
                      aspectRatio: 1,
                      viewMode: 1,
                      minContainerWidth: 200,
                      minContainerHeight: 200,
                    });

                    function submit() {
                      var croppedCanvas;
                      var roundedCanvas;
                      var roundedImage;


                      // Crop
                      croppedCanvas = cropper.getCroppedCanvas();

                      // Round
                      roundedCanvas = getRoundedCanvas(croppedCanvas);
                      roundedCanvas.toBlob(function(blob) {
                        console.log(blob);

                        var formData = new FormData();
                        formData.append('avatar', blob, 'avatar.jpg');
                        formData.append('_token', document.head.querySelector('[name=csrf-token]').content);


                        $.ajax('{{ route("user.ucenter.avatar-update") }}', {
                          method: 'POST',
                          data: formData,
                          processData: false,
                          contentType: false,
                        });
                      });
                    };
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">同步微信头像</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="submit()" class="btn btn-primary">更新头像</button>
            </div>
        </div>
    </div>
</div>

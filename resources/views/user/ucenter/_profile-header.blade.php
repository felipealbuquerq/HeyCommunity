<div class="profile-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');">
    <div class="container">
        <div class="container-inner">
            <label class="label" data-toggle="tooltip" title="" data-original-title="更新头像" style="position:relative;">
                <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}" style="border:2px solid #ddd;">
                <i class="fa fa-edit" style="color:#ddd; font-size:18px; position:absolute; bottom:10px; left:4px;"></i>
                <input type="file" class="sr-only" id="cropper-input-avatar" name="image" accept="image/*">
            </label>

            <label class="label btn btn-sm btn-secondary" style="position:absolute; top:20px; right:20px;">
                <i class="fa fa-image"> 更换封面</i>
                <input type="file" class="sr-only" id="cropper-input-profile-bg-img" name="image" accept="image/*">
            </label>

            <h3 class="profile-header-user">{{ $user->nickname }}</h3>
            <p class="profile-header-bio">
                {{ $user->bio ?: '暂无签名' }}
            </p>
        </div>
    </div>
</div>

<div class="modal fade" id="cropper-modal-avatar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更换头像</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="width:300px; margin:0 auto;">
                    <img id="cropper-img-avatar" src="{{ $user->avatar }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">同步微信头像</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="cropperAjaxSubmit('{{ route("user.ucenter.avatar-update") }}')" class="btn btn-primary">更新</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cropper-modal-profile-bg-img" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更换封面</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center" style="width:80%; margin:0 auto;">
                    <img id="cropper-img-profile-bg-img" src="{{ asset($user->profile_bg_img) }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                <button type="button" onclick="cropperAjaxSubmit('{{ route("user.ucenter.profile-bg-img-update") }}')" class="btn btn-primary">更新</button>
            </div>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.js') }}"></script>

<script>
  //
  // 头像上传模态框裁剪编辑
  cropperModalEdit({
      inputEl: $('#cropper-input-avatar'),
      imageEl: $('#cropper-img-avatar')[0],
      modalEl: $('#cropper-modal-avatar'),
  });

  //
  // 头像上传模态框裁剪编辑
  cropperModalEdit({
    inputEl: $('#cropper-input-profile-bg-img'),
    imageEl: $('#cropper-img-profile-bg-img')[0],
    modalEl: $('#cropper-modal-profile-bg-img'),
  }, {
    aspectRatio: 2.264,
    viewMode: 2,
    minContainerWidth: 200,
    minContainerHeight: 200,
  });
</script>

<style rel="stylesheet">
    .cropper-container {
        margin: 0 auto;
    }
    #cropper-modal-avatar .cropper-view-box,
    #cropper-modal-avatar .cropper-face {
        border-radius: 50%;
    }
</style>

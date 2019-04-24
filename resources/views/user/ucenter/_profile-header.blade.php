<div class="profile-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');">
    <div class="container">
        <div class="container-inner">
            <label class="label" data-toggle="tooltip" title="" data-original-title="更新头像" style="position:relative;">
                <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}" style="border:2px solid #ddd;">
                <i class="fa fa-edit" style="color:#ddd; font-size:18px; position:absolute; bottom:10px; left:4px;"></i>
                <input type="file" class="sr-only" id="cropper-input-avatar" name="image" accept="image/*">
            </label>

            <h3 class="profile-header-user">{{ $user->nickname }}</h3>
            <p class="profile-header-bio">
                {{ $user->bio ?: '暂无签名' }}
            </p>
        </div>

        <div class="row operations">
            <div class="col-sm-6 text-right d-none d-sm-block">
                <button data-toggle="modal" data-target="#cropper-modal-avatar" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</button>
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

<div class="modal fade" id="cropper-modal-avatar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">更新头像</h5>
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
                <button type="button" onclick="cropperAjaxSubmit('{{ route("user.ucenter.avatar-update") }}')" class="btn btn-primary">更新头像</button>
            </div>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
<link href="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/node_modules/cropperjs/dist/cropper.min.js') }}"></script>

<script>
  /**
   * 头像上传模态框裁剪编辑
   */
  cropperModalEdit({
      inputEl: $('#cropper-input-avatar'),
      imageEl: $('#cropper-img-avatar')[0],
      modalEl: $('#cropper-modal-avatar'),
    });
</script>

<style rel="stylesheet">
    .cropper-container {
        margin: 0 auto;
    }
    .cropper-view-box,
    .cropper-face {
        border-radius: 50%;
    }
</style>

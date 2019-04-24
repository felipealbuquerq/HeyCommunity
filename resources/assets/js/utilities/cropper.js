/**
 * 入口方法, 配置 config 即可完成图片的裁剪
 */
window.cropperModalEdit = function(elements, cropperConfig) {
  var inputEl = elements.inputEl;
  var imageEl = elements.imageEl;
  var modalEl = elements.modalEl;

  if (cropperConfig == undefined) {
    cropperConfig = {
      aspectRatio: 1,
      viewMode: 2,
      minContainerWidth: 200,
      minContainerHeight: 200,
    };
  }

  $(inputEl).on('change', function(event) {
    var files = event.target.files;

    // 获取图片 URL
    cropperModalEditInit(files, function(imageData) {
      inputEl.value = '';
      imageEl.src = imageData;
      modalEl.modal('show');
    });
  });

  // 模态框事件
  cropperModalOnShow(modalEl, imageEl, cropperConfig);
  cropperModalOnHide(modalEl);
};


/**
 * 图片文件 base64 转换
 */
window.getRoundedCanvas = function(sourceCanvas) {
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
};


/**
 * cropper 模态框编辑初始化
 * 通过回调方法，把获取到的选中图片转换成 cropper 编辑实体
 */
window.cropperModalEditInit = function(files, callback) {
  if (files && files.length > 0) {
    file = files[0];

    if (URL) {
      callback(URL.createObjectURL(file));
    } else if (FileReader) {
      var reader = new FileReader();
      reader.onload = function() {
        callback(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }
};


/**
 * 模态框的显示和隐藏进行 cropper 的创建和销毁
 */
window.cropper = null;
window.cropperModalOnShow = function(modal, imageEl, cropperParams) {
  console.log('shown fn');
  modal.on('shown.bs.modal', function () {
    window.cropper = new Cropper(imageEl, cropperParams);
    console.log('show', window.cropper);
  });
};
window.cropperModalOnHide = function(modal) {
  modal.on('hidden.bs.modal', function () {
    window.cropper.destroy();
    window.cropper = null;
    console.log('hide', window.cropper);
  });
};


/**
 * 转换后进行 ajax 提交
 */
window.cropperAjaxSubmit = function(action, successCallback, failCallback) {
  if (successCallback == undefined) {
    successCallback = function() {
      window.location.reload();
    }
  }

  if (failCallback == undefined) {
    failCallback = function() {
      window.location.reload();
    }
  }

  var croppedCanvas;
  var roundedCanvas;

  croppedCanvas = window.cropper.getCroppedCanvas();
  roundedCanvas = getRoundedCanvas(croppedCanvas);

  roundedCanvas.toBlob(function(blob) {
    var formData = new FormData();
    formData.append('image', blob, 'image.png');
    formData.append('_token', document.head.querySelector('[name=csrf-token]').content);

    $.ajax(action, {
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: successCallback,
      error: failCallback,
    });
  });
};

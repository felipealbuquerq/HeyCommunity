<form id="section-timeline-create-form" enctype="multipart/form-data" action="{{ route('timeline.store') }}" method="post" onsubmit="submitTimelineForm(event)">
    {{ csrf_field() }}

    <input type="file" name="input-image" accept="image/*" multiple style="display:none;" onchange="uploadImage(event)">

    <li class="media list-group-item p-4" style="display:block;">
        <div class="input-group">
            <input name="content" type="text" class="form-control" placeholder="说点什么 ...">
            <div class="btn-group input-group-append">
                <button type="button" class="btn btn-secondary" onclick="$('#section-timeline-create-form input[name=input-image]').click();">
                    <span class="fa fa-image"></span>
                </button>
                <button type="submit" class="btn btn-secondary">
                    <span class="fa fa-send"></span>
                </button>
            </div>
        </div>
        <div class="text-danger mt-2">
            {{ $errors->first() }}
        </div>

        <div id="area-images" class="mt-2">
            <img class="img img-responsive hidden">
        </div>
    </li>


    <script>
      var timelineFormEl = $('#section-timeline-create-form');
      var timelineFormImageAreaEl = $(timelineFormEl).find('#area-images');
      var timelineFormInputImageIds = [];

      /**
       * Timeline Form Submit
       */
      function submitTimelineForm(event) {
        var formData = new FormData(event.target);

        // check content length
        if (formData.get('content').length < 3) {
          alert('说点什么吧，不能少于 3 个字')
          event.preventDefault();
        }

        // add imageIds input
        timelineFormInputImageIds.forEach(function(imageId) {
          var inputEl = document.createElement('input');
          inputEl.name = 'imageIds[' + imageId + ']';
          inputEl.type = 'hidden';
          inputEl.value = imageId,

          event.target.appendChild(inputEl);
        });
      }

      /**
       * Upload Image
       */
      function uploadImage(event) {
        var formData = new FormData();
        formData.append('_token', $('meta[name=csrf-token]').attr('content'));

        for (var file of event.target.files) {
          formData.append('image', file);
          
          $.ajax({
            url: "{{ route('timeline.upload-image') }}",
            method: 'POST',
            enctype: 'multipart/form-data',
            cache:false,
            contentType: false,
            processData:false,
            data: formData,
            success: function(result) {
              console.log('ajax success', result);
              timelineAddImage(result);
            },
            error: function(xhr, status, error) {
              console.log('ajax error', xhr, status, error);
            }
          });
        }

        $(timelineFormEl).find('input[name=input-image]').val(null);
      }

      /**
       * Timeline Add Image
       */
      function timelineAddImage(image) {
        // display the image
        var imgEl = $(timelineFormEl).find('img.hidden').clone();
        imgEl.attr('src', image.file_path);
        imgEl.appendTo(timelineFormImageAreaEl);
        imgEl.removeClass('hidden');

        timelineFormInputImageIds.push(image.id);
      }

      /**
       * Timeline Remove Image
       */
    </script>
</form>


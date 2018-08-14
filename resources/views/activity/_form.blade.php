@php
if (!isset($activity)) {
    $activity = null;
}
@endphp

<div class="form-group row">
    <label for="input-title" class="col-sm-2 col-form-label">活动标题</label>
    <div class="col-sm-10">
        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', formValue($activity, 'title')) }}">

        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-avatar" class="col-sm-2 col-form-label">活动封面</label>
    <div class="col-sm-10">
        <input name="avatar" type="file" accept="image/*" class="form-control" id="input-avatar" value="{{ old('avatar', formValue($activity, 'avatar')) }}">

        <div class="text-danger">{{ $errors->first('avatar') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">活动分类</label>
    <div class="col-sm-10">
        <select class="form-control" id="input-category_id" name="category_id">
            <option>请选择分类</option>
            @php
                $categories = \App\ActivityCategory::sortOrder()->get();
            @endphp
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', formValue($activity, 'category_id')) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="text-danger">{{ $errors->first('category_id') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">活动时间</label>
    <div class="col-sm-10">
        <div class="input-group">
            <input name="start_time" type="text" class="form-control" id="input-start_time" value="{{ old('start_time', formValue($activity, 'start_time')) }}" placeholder="开始时间">

            <div class="input-group-prepend">
                <span class="input-group-text">至</span>
            </div>

            <input name="end_time" type="text" class="form-control" id="input-end_time" value="{{ old('end_time', formValue($activity, 'end_time')) }}" placeholder="结束时间">
        </div>

        @if (!$errors->has('start_time'))
            <div class="text-dark">格式如: {{ date('Y-m-d H:i:s', \Carbon\Carbon::today()->addHours(10)->timestamp) }}</div>
        @endif
        <div class="text-danger">{{ $errors->first('start_time') }}</div>
        <div class="text-danger">{{ $errors->first('end_time') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-local" class="col-sm-2 col-form-label">活动地点</label>

    <div class="col-sm-3">
        <select class="form-control" id="input-area_id" name="area_id">
            <option>请选择区域</option>
            @php
                $areas = \App\ActivityArea::sortOrder()->get();
            @endphp
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" {{ old('area_id', formValue($activity, 'area_id')) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
            @endforeach
        </select>

        <div class="text-danger">{{ $errors->first('area_id') }}</div>
    </div>

    <div class="col-sm-7">
        <input name="local" type="text" class="form-control" id="input-local" value="{{ old('local', formValue($activity, 'local')) }}">

        <div class="text-danger">{{ $errors->first('local') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-redirect_url" class="col-sm-2 col-form-label">外链页面</label>
    <div class="col-sm-10">
        <input name="redirect_url" type="text" class="form-control" id="input-redirect_url" value="{{ old('redirect_url', formValue($activity, 'redirect_url')) }}">

        <div class="text-danger">{{ $errors->first('redirect_url') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-intro" class="col-sm-2 col-form-label">活动介绍</label>
    <div class="col-sm-10">
        <textarea name="intro" class="form-control" id="input-intro" rows="3">{{ old('intro', formValue($activity, 'intro')) }}</textarea>

        <div class="text-danger">{{ $errors->first('intro') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-content" class="col-sm-2 col-form-label">活动详情</label>
    <div class="col-sm-10">
        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content', formValue($activity, 'content')) }}</textarea>

        <div class="text-danger">{{ $errors->first('content') }}</div>
    </div>
</div>

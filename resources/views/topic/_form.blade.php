<div class="form-group row">
    <label for="input-title" class="col-sm-2 col-form-label">标题</label>
    <div class="col-sm-10">
        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $topic->title) }}">

        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-node" class="col-sm-2 col-form-label">节点</label>
    <div class="col-sm-10">
        <select name="node_id" class="custom-select form-control">
            <option selected>请选择一个节点</option>
            @foreach ($rootNodes as $rootNode)
                <optgroup label="{{ $rootNode->name }}">
                    @foreach ($rootNode->childNodes as $node)
                        <option value="{{ $node->id }}" {{ $node->id == old('node_id', $topic->node_id) ? 'selected' : '' }}>
                            {{ $node->name }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>

        <div class="text-danger">{{ $errors->first('node_id') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-content" class="col-sm-2 col-form-label">内容</label>
    <div class="col-sm-10">
        <textarea name="content" class="form-control" id="ckeditor" rows="8">{{ old('content', $topic->content) }}</textarea>

        <div class="text-danger">{{ $errors->first('content') }}</div>

        @include('layouts.ckeditor5.ckeditor-classic')
    </div>
</div>


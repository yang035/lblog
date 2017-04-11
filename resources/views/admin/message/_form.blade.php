<div class="form-group">
    <label for="title" class="col-md-3 control-label">
        Title
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
    </div>
</div>

<div class="form-group">
    <label for="content" class="col-md-3 control-label">
        Content
    </label>
    <div class="col-md-8">
        <textarea class="form-control" id="content" name="content" rows="3">
            {{ $content }}
        </textarea>
    </div>
</div>

<div class="form-group">
    <label for="status" class="col-md-3 control-label">
        Status
    </label>
    <div class="col-md-7">
        <label class="radio-inline">
            <input type="radio" name="status" id="status"
                   @if (! $status)
                   checked="checked"
                   @endif
                   value="0">
            禁用
        </label>
        <label class="radio-inline">
            <input type="radio" name="status"
                   @if ($status)
                   checked="checked"
                   @endif
                   value="1">
            启用
        </label>
    </div>
</div>
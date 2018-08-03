<div class="form-group has-feedback col-xs-8 col-md-8 col-lg-8 {{ $errors->has('title') ? 'has-error' : '' }}">
    <label>title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title ?: old('title') }}" id="title" required>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
</div> <div class="form-group has-feedback col-xs-8 col-md-8 col-lg-8 {{ $errors->has('content') ? 'has-error' : '' }}">
    <label>content</label>
        <textarea name="content" class="form-control" id="content" required>{!! $post->content ?: old('content') !!}</textarea>

        @if ($errors->has('content'))
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
</div><div class="form-group has-feedback col-xs-8 col-md-8 col-lg-8 {{ $errors->has('email') ? 'has-error' : '' }}">
    <label>email</label>
        <input type="email" name="email" class="form-control" value="{{ $post->email ?: old('email') }}" id="email" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
</div><div class="form-group has-feedback col-xs-8 col-md-8 col-lg-8 {{ $errors->has('number') ? 'has-error' : '' }}">
    <label>number</label>
        <input type="number" name="number" class="form-control" value="{{ $post->number ?: old('number') }}" id="number" >
            @if ($errors->has('number'))
                <span class="help-block">
                    <strong>{{ $errors->first('number') }}</strong>
                </span>
            @endif
</div>    <div class="form-group has-feedback col-xs-12 col-md-12 col-lg-12 {{ $errors->has('image') ? 'has-error' : '' }}">

        <label>image</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" class="imgInp" name="image">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>

        @if($post->image)
            <img src="/uploads/post/{{ ($post->image) }}" class="img-thumbnail img-upload">
        @else
            <img src="/images/default-thumbnail.png" class="img-thumbnail img-upload">
        @endif

        @if($errors->has("image"))
            <div class="invalid-feedback">
                {{$errors->first("image")}}
            </div>
        @endif

    </div><div class="form-group has-feedback col-xs-8 col-md-8 col-lg-8 {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="%1$s" class="col-md-4 control-label">category</label>
    <div class="col-md-6">
	<select name="category" class="form-control" id="category" >
	    @foreach (json_decode('{"technology":"Technology","tips":"Tips","health":"Health"}', true) as $optionKey => $optionValue)
	        <option value="{{ $optionKey }}" {{ (isset($post->category) && $post->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
	    @endforeach
	</select>
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>
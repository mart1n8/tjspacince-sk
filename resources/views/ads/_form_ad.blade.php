<div class="row">
  <div class="form-group col-6">
    <label for="title">Title: </label>
    <input type="text" name="title" class="form-control{{ $errors->has('points') ? ' is-invalid' : ''}}" value="{{ old('title', $ad->title) }}">
    @if ($errors->has('title'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="url">URL: </label>
    <input type="url" name="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : ''}}" value="{{ old('url', $ad->url) }}">
    @if ($errors->has('url'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('url') }}</strong>
        </span>
    @endif
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <label for="banner">Banner: </label>
    <input type="file" name="banner" class="form-control{{ $errors->has('banner') ? ' is-invalid' : ''}}" >
    @if ($errors->has('banner'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('banner') }}</strong>
        </span>
    @endif
  </div>
  <div class="form-group col-6">
    <label for="banner_size">Size: </label>
    <select name="banner_size" class="form-control{{ $errors->has('banner_size') ? ' is-invalid' : ''}}">
        <option value="300x250">300x250</option>
        <option value="300x600">300x600</option>
        <option value="320x100">320x100</option>
        <option value="336x280">336x280</option>
        <option value="728x90">728x90</option>
    </select>
    @if ($errors->has('banner_size'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('banner_size') }}</strong>
        </span>
    @endif
  </div>
</div>
<div class="row">
  <div class="col-12">
      <button class="btn btn-primary"> Uložiť </button>
  </div>
</div>

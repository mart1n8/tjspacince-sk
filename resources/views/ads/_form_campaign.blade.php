<div class="row">
    <div class="form-group col-6">
        <label for="name">Názov kampane:</label>
        <input type="text" name="name" value="{{ old('name', $campaign->name) }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : ''}}">
        @if ($errors->has('name'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="company">Spoločnosť:</label>
        <input type="text" name="company" value="{{ old('company', $campaign->company) }}" class="form-control{{ $errors->has('company') ? ' is-invalid' : ''}}">
        @if ($errors->has('company'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('company') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="generalURL">Hlavný link:</label>
        <input type="text" name="generalURL" value="{{ old('generalURL', $campaign->generalURL) }}" class="form-control{{ $errors->has('generalURL') ? ' is-invalid' : ''}}">
        @if ($errors->has('generalURL'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('generalURL') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="name">Body:</label>
        <input type="text" name="points" value="{{ old('points', $campaign->points) }}" class="form-control{{ $errors->has('points') ? ' is-invalid' : ''}}">
        @if ($errors->has('points'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('points') }}</strong>
            </span>
        @endif
        <small>* default -1 = nekonecne</small>
    </div>
</div>
<div class="row">
    <div class="form-group">
      <button class="btn btn-primary"> Uložiť </button>
    </div>
</div>

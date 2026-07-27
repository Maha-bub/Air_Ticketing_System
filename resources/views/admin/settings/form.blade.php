@csrf

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Site Name</label>
        <input type="text" name="site_name" class="form-control"
            value="{{ old('site_name', isset($item) ? $item->site_name : '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Site Email</label>
        <input type="email" name="site_email" class="form-control"
            value="{{ old('site_email', isset($item) ? $item->site_email : '') }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone Number</label>
        <input type="text" name="site_phone" class="form-control"
            value="{{ old('site_phone', isset($item) ? $item->site_phone : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control"
            value="{{ old('address', isset($item) ? $item->address : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Facebook URL</label>
        <input type="url" name="facebook_url" class="form-control" placeholder="https://facebook.com/..."
            value="{{ old('facebook_url', isset($item) ? $item->facebook_url : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Twitter / X URL</label>
        <input type="url" name="twitter_url" class="form-control" placeholder="https://twitter.com/..."
            value="{{ old('twitter_url', isset($item) ? $item->twitter_url : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Instagram URL</label>
        <input type="url" name="instagram_url" class="form-control" placeholder="https://instagram.com/..."
            value="{{ old('instagram_url', isset($item) ? $item->instagram_url : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">YouTube URL</label>
        <input type="url" name="youtube_url" class="form-control" placeholder="https://youtube.com/..."
            value="{{ old('youtube_url', isset($item) ? $item->youtube_url : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="logo">Site Logo</label>
        <div class="form-text mb-1">Used in the website header and admin sidebar.</div>
        @if (!empty($item) && $item->logo)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $item->logo) }}" width="80" style="border-radius:4px;">
            </div>
        @endif
        <input class="form-control" id="logo" name="logo" type="file" accept="image/*">
    </div>

    <div class="col-md-6">
        <label class="form-label" for="favicon">Favicon (Browser Tab Icon)</label>
        <div class="form-text mb-1">A small square image (e.g. 32x32 or 64x64 px) shown in the browser tab.</div>
        @if (!empty($item) && $item->favicon)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $item->favicon) }}" width="32" height="32"
                    style="border-radius:4px;">
            </div>
        @endif
        <input class="form-control" id="favicon" name="favicon" type="file" accept="image/*">
    </div>

    <div class="col-12">
        <label class="form-label">Footer Text</label>
        <textarea name="footer_text" rows="3" class="form-control">{{ old('footer_text', isset($item) ? $item->footer_text : '') }}</textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </div>
</div>

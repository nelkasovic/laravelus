@csrf
<input name="keyword" id="keyword" type="hidden" value="{{ isset($keyword) ? $keyword : '' }}">
<input name="_method" type="hidden" value="GET">
<select class="form-control" data-width="auto" data-style="btn-light" id="show" name="show"
    title="{{ __('common.Display') }}" onchange="this.form.submit()">
    <option value="10" {{ ($show == 10 ? 'selected':'') }}>10</option>
    <option value="20" {{ ($show == 20 ? 'selected':'') }}>20</option>
    <option value="30" {{ ($show == 30 ? 'selected':'') }}>30</option>
    <option value="40" {{ ($show == 40 ? 'selected':'') }}>40</option>
    <option value="50" {{ ($show == 50 ? 'selected':'') }}>50</option>
    <option value="100" {{ ($show == 100 ? 'selected':'') }}>100</option>
    <option value="200" {{ ($show == 200 ? 'selected':'') }}>200</option>
    <option value="{{ $total }}" {{ ($show == $total ? 'selected':'') }}>{{ __('common.All') }}</option>
</select>
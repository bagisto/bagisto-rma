@if (Request::segment(1) === config('app.admin_url'))
    @bagistoVite(['src/Resources/assets/css/admin.css'], 'rma')
@else
    @bagistoVite(['src/Resources/assets/css/app.css'], 'rma')
@endif
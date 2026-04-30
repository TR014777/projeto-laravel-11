@if (session()->has('success'))
<div style="padding: 8px 12px 8px 12px; color: #ffffff; border-width: 1px; border-radius: 6px;" role="alert">
    {{ session('success') }}
    </div>
@endif

@if (session()->has('message'))
<div style="padding: 8px 12px 8px 12px; color: rgb(220 38 38 / var(--tw-bg-opacity, 1)); border-color: rgb(220 38 38 / var(--tw-border-opacity, 1)); border-width: 1px; border-radius: 6px;" role="alert">
    {{ session('message') }}
    </div>
@endif

@if (session()->has('error'))
<div style="padding: 8px 12px 8px 12px; background-color: rgb(220 38 38 / var(--tw-bg-opacity, 1)); color: #ffffff; border-radius: 6px;" role="alert">
    {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <ul style="background-color: rgb(220 38 38 / var(--tw-bg-opacity, 1)); color: #ffffff; border-radius: 6px; padding: 8px 12px 8px 12px;">
        @foreach ($errors->all() as $error)
            <li role="alert">{{ $error }}</li>
        @endforeach
    </ul>
@endif
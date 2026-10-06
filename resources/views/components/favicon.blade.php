@if ($companyProfile?->logo)
    <link rel="icon" href="{{ asset('storage/' . $companyProfile->logo) }}">
@endif
@extends('layouts.app')

@section('title', 'About Clearbasin Septic Systems')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <p class="font-display text-5xl font-extrabold text-pine">Clearbasin</p>
    <h1 class="mt-3 text-2xl font-semibold text-ink/80">A septic company built around soil science and clean installs</h1>
    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1400&q=80"
             alt="Hudson Valley style home with yard suitable for septic drain-field planning"
             class="h-80 w-full rounded-2xl object-cover">
        <div class="space-y-4 text-ink/80">
            <p>Clearbasin started in Poughkeepsie with a simple rule: never size a tank without understanding the soil. Our crews specialize in residential and light-commercial septic — conventional systems, chamber fields, pump stations, and ATU upgrades.</p>
            <p>We coordinate perc tests, county permits, and final inspections, then restore lawns and driveways. The ERP at /admin is the same system that schedules excavators, tracks tank inventory, and invoices on completion.</p>
            <p>Service area: Poughkeepsie, Kingston, Newburgh, Beacon, Rhinebeck, Hyde Park, and nearby Mid-Hudson communities.</p>
        </div>
    </div>
</section>
@endsection

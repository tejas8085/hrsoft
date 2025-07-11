@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h3 class="mb-4">📄 {{ ucfirst($certificate->type) }} Letter</h3>

    <div class="mb-3">
        <a href="{{ route('certificates.pdf', $certificate->id) }}" class="btn btn-outline-dark" target="_blank">
            🖨️ Download as PDF
        </a>
        <a href="{{ route('staff.dashboard') }}" class="btn btn-outline-secondary ms-2">← Back</a>
    </div>

    <div class="card p-4 shadow-sm">
        {!! $certificate->content !!}
    </div>
</div>
@endsection

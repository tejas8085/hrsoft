@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Certificates</h2>

    @if($certificates->isEmpty())
        <p>No certificates found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Generated On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certificates as $certificate)
                    <tr>
                        <td>{{ ucfirst($certificate->type) }} Letter</td>
                        <td>{{ $certificate->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('certificates.view', $certificate->id) }}" class="btn btn-sm btn-primary" target="_blank">View</a>
                            <a href="{{ route('certificates.download', $certificate->id) }}" class="btn btn-sm btn-secondary">Download PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@extends('dashboard-user.layouts.app')

@section('content')
<embed src="{{route('fpdf')}}" type="application/pdf" width="100%" height="600px" />
<iframe src="{{ route('fpdf') }}" frameborder="0"></iframe>
@endsection


@section('page-js')
@endsection

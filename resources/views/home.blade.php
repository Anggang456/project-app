@extends('layouts.app')

@section('content')
@role('admin')
@include('admin')
@else
@include('atasan')
@endrole
@endsection
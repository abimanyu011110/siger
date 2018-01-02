@extends('layout.index')
@section('isi')
	<h4>Selamat Datang</h4>
	<h1><b>{{Auth::user()->nama}}</b></h1>
@endsection
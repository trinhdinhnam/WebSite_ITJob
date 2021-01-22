@extends('layouts.master')
@section('main')
    <embed src="{{asset( pare_url_file($seekerJob->CVLink)) }}" width="1300" height="1580" type="application/pdf">
@endsection
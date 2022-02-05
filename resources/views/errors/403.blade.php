@extends('errors::minimal')

@section('title', __('No autorizado'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'No autorizado'))

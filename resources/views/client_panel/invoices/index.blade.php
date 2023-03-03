@extends('client_panel.layouts.app')
@section('title')
    Invoices
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column ">
        @include('flash::message')
        <livewire:client-invoice-table/>
    </div>
</div>
    {{ Form::hidden('status', $status,['id' => 'status']) }}
@endsection

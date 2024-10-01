@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content_header')
<h1>Admin Dashboard</h1>
@stop

@section('content')
<div class="heading">
    <h1>Welcome to the Admin Dashboard!</h1>
</div>

<div class="row">
    <div class="box col-lg-3 col-6">
        <div class="small-box bg-danger-custom">
            <div class="inner">
                <h3>{{ $adminsCount }}</h3>
                <h5>Admins</h5>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="{{ route('admin.admins.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success-custom">
            <div class="inner">
                <h3>{{ $teachersCount }}</h3>
                <h5>Teachers</h5>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info-custom">
            <div class="inner">
                <h3>{{ $classesCount }}</h3>
                <h5>Classes</h5>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard"></i>
            </div>
            <a href="{{ route('classes.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning-custom">
            <div class="inner">
                <h3>{{ $sectionsCount }}</h3>
                <h5>Sections</h5>
            </div>
            <div class="icon">
                <i class="fas fa-sitemap"></i>
            </div>
            <a href="{{ route('sections.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@stop
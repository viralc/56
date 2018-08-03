@extends('layouts.app')

@section('title') Post - Form @stop

@section('page_title') Post @stop
@section('page_subtitle') @if ($post->exists) Editing Post: {{ $post->id }} @else Add New Post @endif @stop

@section('title')
  @parent
  Post
@stop

@section('content')
<div class="container">
  <div class="row">
    @include('admin.sidebar')
    <div class="col-md-9">
      {!! Form::open(['method' => 'post', 'route' => 'admin.post.save', 'files'=>true]) !!}
      <div class="card">

        <div class="card-body row">
            {!! Form::hidden('id', $post->id) !!}
            @include ('admin.posts.form')
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-sm-8">
              <input type="submit" class="btn-primary btn" value="Save">
            </div>
          </div>
        </div>

      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@stop

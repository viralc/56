@extends('layouts.app')

@section('title') Post - Index @stop

@section('page_title') Post @stop
@section('page_subtitle') Index @stop
@section('page_icon') <i class="icon-folder"></i> @stop

@section('content')
<div class="container">
  <div class="row">
    @include('admin.sidebar')
    <div class="col-md-9">
        <div class="card">

            <div class="card-header">
                <a href="{{ route('admin.post.new') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;New</a>
                <div class="btn-group float-right">
                    @if(count(Request::input()))
                        <a class="btn btn-default" href="{{ route('admin.post.index') }}">Clear</a>
                        <a class="btn btn-primary" id="searchButton" data-toggle="modal" data-target="#searchModal">Modify Search</a>
                    @else
                        <a class="btn btn-default" id="searchButton" data-toggle="modal" data-target="#searchModal"><i class="icon-search"></i>&nbsp;&nbsp;Search</a>
                    @endif
                </div>
            </div>


            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <tbody>
                        <thead>
                            <tr>
                                <td>Title</td><td>Content</td><td>Email</td>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach($postsData as $postItem)
                        <tr>
                             <td>{{$postItem->title}}</td><td>{{$postItem->content}}</td><td>{{$postItem->email}}</td>
                            <th>
                                <span class="float-right">
                                @if(!$postItem->deleted_at)
                                    <a href="{{ route('admin.post.form', $postItem->id) }}" class="btn btn-primary btn-xs">Edit</a>
                                    <a href="#" class="btn btn-xs btn-warning" data-target="#deleteModal{{ $postItem->id }}" data-toggle="modal" >Delete</a>


                                    <!-- modal starts -->
                                    <div class="modal fade" id="deleteModal{{ $postItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                {!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'route' => ['admin.post.delete', $postItem->id]]) !!}
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Delete: {{ $postItem->id }} </h4>
                                                </div>
                                
                                                <div class="modal-body">
                                                    Are you sure you want to delete <code>{{ $postItem->id }} ?</code>
                                                </div>
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'data-disable-with' => trans('Deleting...')]) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal ends -->

                                @else

                                    <a href="#" class="btn btn-xs btn-success" data-target="#restoreModal{{ $postItem->id }}" data-toggle="modal" >Restore</a>
                                    <a href="#" class="btn btn-xs btn-danger" data-target="#forceDeleteModal{{ $postItem->id }}" data-toggle="modal" >Permanently Delete</a>


                                    <!-- modal starts -->
                                    <div class="modal fade" id="restoreModal{{ $postItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                {!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'route' => ['admin.post.restore', $postItem->id]]) !!}
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Restore: {{ $postItem->id }} </h4>
                                                </div>
                                
                                                <div class="modal-body">
                                                    Are you sure you want to RESTORE <code>{{ $postItem->id }} ?</code>
                                                </div>
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    {!! Form::submit('Restore', ['class' => 'btn btn-primary', 'data-disable-with' => trans('Restoring...')]) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal ends -->



                                    <!-- modal starts -->
                                    <div class="modal fade" id="forceDeleteModal{{ $postItem->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                {!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'route' => ['admin.post.force-delete', $postItem->id]]) !!}
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"> Permanently: {{ $postItem->id }} </h4>
                                                </div>
                                
                                                <div class="modal-body">
                                                    Are you sure you want to PERMANENTLY DELTE <code>{{ $postItem->id }} ? Please note that this action cannot be reversed!</code>
                                                </div>
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    {!! Form::submit('PERMANENTLY DELETE', ['class' => 'btn btn-danger', 'data-disable-with' => trans('Permanently Deleting...')]) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal ends -->

                                @endif
                            </span>
                            </th>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $postsData->links() !!}
            </div>
        </div>

        <!-- post search modal -->
        <div class="modal fade" id="searchModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['class' => 'form-horizontal', 'method' => 'get', 'route' => 'admin.post.index']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Search posts</h4>
                    </div>

                    <div class="modal-body">                  
                        <div class='form-group'>{!! Form::label('title', 'title', ['class' => 'col-sm-3']) !!}<div class='col-sm-9'>{!! Form::text('title', Request::get('title'), ['class' => 'form-control']) !!}</div></div><div class='form-group'>{!! Form::label('content', 'content', ['class' => 'col-sm-3']) !!}<div class='col-sm-9'>{!! Form::text('content', Request::get('content'), ['class' => 'form-control']) !!}</div></div><div class='form-group'>{!! Form::label('email', 'email', ['class' => 'col-sm-3']) !!}<div class='col-sm-9'>{!! Form::text('email', Request::get('email'), ['class' => 'form-control']) !!}</div></div>                                       
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- search modal ends -->


    </div>
  </div>
</div>

@stop

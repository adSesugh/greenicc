@extends('layouts.master')

@section('title') {{$news->title }} Profile @stop

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="News Post" action="profile" />

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">
                                {{$news->title}} Profile 
                                <small>
                                    @if($news->published)
                                        <span class="badge badge-pill badge-success">Published</span>
                                    @else
                                        <span class="badge badge-pill badge-info">Unpublished</span>
                                    @endif
                                </small>
                            </h4>
                            <hr>
                            <div class="form-group row">
                                <div class="col-12" style="text-align:justify;">
                                    {!! $news->body !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card m-b-20">
                        <div class="card-body">
                            @if(count($news->newsComment) > 0)
                                <div class="col-12">
                                    <div class="row mb-20">
                                        <h4 class="mt-0 header-title">@yield('title')</h4>
                                        <p class="text-muted m-b-30 font-14">&nbsp;</p>
                                        <hr>
                                        <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Comment</th>
                                                    <th>Published?</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($post->newsComment as $item)
                                                    <tr>
                                                        <td>
                                                            <h5>{{ $item->name }}</h5>
                                                            <p>{{ $item->email }}</p>
                                                        </td>
                                                        <td>
                                                            {!! $item->comment !!}
                                                        </td>
                                                        <td align="center">
                                                            <x-status :state="$news->published" />
                                                        </td>
                                                        <td align="center">
                                                            @if($post->published == 1)
                                                                <a href="{{ route('news.action', $item->id) }}"
                                                                    onclick="event.preventDefault();
                                                                        document.getElementById('publish').submit();">
                                                                        <span class="badge badge-pill badge-success"><i class="ion-unlocked"></i> Published</span>
                                                                </a>
                                                                <form id="publish" action="{{ route('news.action', $item->id) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    <input type="hidden" name="published" id="published" value=0>
                                                                </form>
                                                            @else
                                                                <a href="{{ route('news.action', $item->id) }}" 
                                                                    onclick="event.preventDefault();
                                                                        document.getElementById('unpublish').submit();">
                                                                        <span class="badge badge-pill badge-info p-2"><i class="ion-locked"></i> Unpublished</span>
                                                                </a>
                                                                <form id="unpublish" action="{{ route('news.action', $item->id) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    <input type="hidden" name="published" id="published" value=1>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="col-12" style="text-align:center;">
                                    No Comment found!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
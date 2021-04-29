@extends('layouts.master')

@section('title') Gallery @stop

@section('css')
<!-- Magnific popup -->
<link href="{{URL::to('assets/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Gallery" action="List" />
    <div class="card m-b-20">
        <div class="card-header">
            <div class="mb-30">
                <a href="{{ route('media.create') }}" class="btn btn-primary float-right mt-20"><i class="ion-plus"></i> Add Gallery</a>
            </div>
            <h4 class="mt-0 header-title">@yield('title')</h4>
        </div>
        <div class="card-body">
            <div class="row zoom-gallery">
                @forelse ($galleries as $item)
                    <div class="col-lg-2">
                        <a class="float-left p-1" href="{{ URL::to($item->picture) }}" title="{{$item->type}}"><img src="{{ URL::to($item->picture) }}" alt="" width="180"></a>
                    </div>
                @empty
                    <div class="col-lg-12" style="text-align: center;">
                        <span>No Gallery exists!</span>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="card-footer">
            <div class="float-righ">
                {!! $galleries->render() !!}
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
@endsection

@section('script')
 <!-- Magnific popup -->
 <script src="{{URL::to('assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
 <script src="{{URL::to('assets/pages/lightbox.js')}}"></script>
@endsection
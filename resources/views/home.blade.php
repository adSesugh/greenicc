@extends('layouts.master')

@section('title') Dashboard @stop

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <x-breadcrumb type="Dashboard" action="Management" />

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-book-open float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3">Enquiry</h6>
                        <h4 class="mb-4">{{ $enqCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-account-multiple float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3">Clients</h6>
                        <h4 class="mb-4">{{ $clientCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-email-secure float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3">Email Account</h6>
                        <h4 class="mb-4">0</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary">
                <div class="card-body mini-stat-img">
                    <div class="mini-stat-icon">
                        <i class="mdi mdi-buffer float-right"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="text-uppercase mb-3">Projects</h6>
                        <h4 class="mb-4">{{ $projectCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner" role="listbox">
                    @forelse ($enqArray as $enq)
                        <div class="card widget-user m-b-20 carousel-item @if($loop->first) active @endif">
                            <div class="widget-user-desc p-4 text-center bg-primary position-relative">
                                <i class="fas fa-quote-left h3 text-white-50"></i>
                                <p class="text-white mb-0">{{ $enq->message }}</p>
                            </div>
                            <div class="p-4">
                                <h6 class="mb-1">{{ $enq->name }}</h6>
                                <p class="text-muted mb-0">{{ $enq->phone }}</p>
                                <p class="text-muted mb-0">{{ $enq->email }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="card widget-user m-b-20 carousel-item">
                            <div class="widget-user-desc p-4 text-center bg-primary position-relative">
                                <i class="fas fa-quote-left h3 text-white-50"></i>
                                <p class="text-white mb-0">Enquiry List</p>
                            </div>
                            <div class="p-4">
                                <h6 class="mb-1">Not Found!</h6>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 m-b-30 header-title">Email Account</h4>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <div>
                                <div class="input-group">
                                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="mdi mdi-check"></i> Submit</button>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-vertical">
                            <tbody>
                                {{-- @forelse ( as )
                                    <tr>
                                        <td>
                                            <img src="{{ URL::asset('assets/images/users/user-2.jpg')}}" alt="user-image"
                                                class="thumb-sm rounded-circle mr-2" />
                                            Herbert C. Patton
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                        <td>
                                            $14,584
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            5/12/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <img src="{{ URL::asset('assets/images/users/user-2.jpg')}}" alt="user-image"
                                                class="thumb-sm rounded-circle mr-2" />
                                            Herbert C. Patton
                                        </td>
                                        <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Confirm</td>
                                        <td>
                                            $14,584
                                            <p class="m-0 text-muted font-14">Amount</p>
                                        </td>
                                        <td>
                                            5/12/2016
                                            <p class="m-0 text-muted font-14">Date</p>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-secondary btn-sm waves-effect waves-light">Edit</button>
                                        </td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
@endsection

@section('script')
    <!--Morris Chart-->
    <script src="{{ URL::asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{ URL::asset('assets/plugins/raphael/raphael-min.js')}}"></script>

    <script src="{{ URL::asset('assets/pages/dashboard.js')}}"></script>
@endsection

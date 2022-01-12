@extends('layout.adminHeader')
@section('title') Sliders @endsection
@section('content')
    <div class="container-fluid"  id="sliders">
        <div class="w-100 p-2" style="background-color: #8f636d">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="mx-3 mt-2 w-25 text-white">Sliders</h5>
                </div>
                <div class="col-md-2 d-flex justify-content-around">
                    <button type="button" ref="new"  class="btn btn-light  new">New</button>
                </div>
            </div>
        </div>
        <div class="w-75 p-4  mt-4" style="margin: auto">
            <table class="table" ref="slidersTable">
            </table>
        </div>
    </div>
    @include('admin.slidebar.modal.newSliders')
@endsection
@section('script')
    <script src="{{ asset('js/admin/Sliders.js') }}"></script>
@endsection


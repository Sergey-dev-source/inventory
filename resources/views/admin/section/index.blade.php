@extends('layout.adminHeader')
@section('title') Section @endsection

@section('content')
    <div class="container-fluid"  id="section">
        <div class="w-100 bg-dark p-2">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="mx-3 mt-2 w-25 text-white">Section</h5>
                </div>
                <div class="col-md-2 d-flex justify-content-around">
                    <button type="button" ref="new"  class="btn btn-light  new">New</button>
                </div>
            </div>
        </div>
        <div class="w-75 p-4  mt-4" style="margin: auto">
            <table class="table" ref="sectionTable">

            </table>
        </div>
    </div>
    @include('admin.section.modal.newSection')
@endsection

@section('script')
    <script src="{{ asset('js/admin/Section.js') }}"></script>
@endsection



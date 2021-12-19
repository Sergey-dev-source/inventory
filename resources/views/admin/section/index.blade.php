@extends('layout.adminHeader')
@section('title') Section @endsection

@section('content')
    <div class="container-fluid">
        <div class="w-100 bg-dark p-2">
            <div class="row">
                <div class="col-md-11">
                    <h5 class="mx-3 mt-2 w-25 text-white">Section</h5>
                </div>
                <div class="col-md-1 d-flex">
                    <button type="button" ref="edit" href="" class="btn btn-light  edit">Add</button>
                    <button type="button" ref="save" class="btn btn-success save">Save</button>
                    <button type="button" ref="cancel" class="btn btn-danger cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/section.js') }}"></script>
@endsection



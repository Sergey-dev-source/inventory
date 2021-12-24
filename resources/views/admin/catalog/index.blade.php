@extends('layout.adminHeader')
@section('title') Section @endsection

@section('content')
    <div class="container-fluid" style="padding:0" id="catalog">
        <div class="w-100 bg-dark p-2">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="mx-3 mt-2 w-25 text-white">Catalog</h5>
                </div>
                <div class="col-md-2 d-flex justify-content-around">
                    <button type="button" ref="edit"  class="btn btn-light  edit">Edit</button>
                    <button type="button" ref="save" class="btn btn-success d-none save">Save</button>
                    <button type="button" ref="cancel" class="btn btn-danger d-none cancel">Cancel</button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6" id="section">
                <div class="w-100 bg-info p-2">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mx-3 mt-2 w-25 text-white">Section</h5>
                        </div>
                        <div class="col-md-3">
                            <button type="button" ref="addSection"  class="btn btn-light d-none edit">Create Section</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="category">
                <div class="w-100 bg-info p-2">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="mx-3 mt-2 w-25 text-white">Category</h5>
                        </div>
                        <div class="col-md-3">
                            <button type="button" ref="addCategory"  class="btn btn-light d-none edit">Create Category</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/Catalog.js') }}"></script>
@endsection



@extends('layout.header')

@section('title')settings @endsection
@section('content')
    <div class="content"><div class="content_header">
            <span class="text-white">
                <i class='bx bxs-edit'></i>
                    Update system settings
            </span>
            <span class="d-flex align-items-center">
                <button class="btn btn-light d-flex align-items-center mr-4" type="button" onclick="history.back();">
                    <i class='bx bxs-chevron-left'></i>
                    back
                </button>
                <a href="#" class="btn btn-success d-flex align-items-center" onclick="document.getElementById('setting').submit();">
                    <i class='bx bx-chevron-down'></i>
                    save
                </a>
            </span>
        </div>
        <div class="content_body ">
            <div class="col-md-6">
                <form action="{{ route('user.settings.post') }}" method="post" id="setting" >
                    @csrf
                    <div class="form-group">
                        <label for="currency">Currency:</label>
                        <select name="currency_id" class="form-control"   id="currency" >
                            <option value="">Select currency</option>
                            @foreach($currency as $item)
                                <option value="{{ $item['id'] }}" {{ \Illuminate\Support\Facades\Auth::user()->currency_id == $item['id'] ? 'selected' : '' }}>{{ $item['description'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="zone">Zones (UTC):</label>
                        <select name="time_zone_id" class="form-control"   id="zone" >
                            <option value="">Select zone</option>
                            @foreach($zone as $item)
                                <option value="{{ $item['id'] }}" {{ \Illuminate\Support\Facades\Auth::user()->time_zone_id == $item['id'] ? 'selected' : '' }}>{{ $item['zone_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('select').select2();
        });
    </script>
@endsection
@section('abs')

    @if(session('success'))
        <div id="success">
            <div class="warn_icon">
                <i class='bx bx-check-double'></i>
            </div>
            <div class="warn_text">
                <div>{{session('success')}}</div>
            </div>
            <div class="warn_close" onclick="document.getElementById('success').style.display = 'none'" >
                <i class='bx bx-x'></i>
            </div>
        </div>
    @endif
@endsection

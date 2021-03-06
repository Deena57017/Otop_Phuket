@extends('admin.layout')
@section('title', 'หน้าแก้ไขอำเภอ')
@section('content')
    <br>
    <div class="w3-container w3-section">
        <div class="card text-black ">
            @if(isset($district))
                <div class="card-header bg-warning mb-3"><h6><i class="fa fa-city  fa-fw"></i> แก้ไขอำเภอ</h6></div>
                <form action="{{url('district/update')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <b style="margin-left: 70px">
                            @if ($errors->has('district_name'))
                                <span class="text-danger">{{ $errors->first('district_name') }}</span>
                            @endif
                        </b>
                        <div class="input-group mb-3">
                            อำเภอ : <br>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-city fa-fw"></i></span>
                            </div>
                            <input name="district_id" type="hidden" value="{{$district->district_id}}">
                            <input type="text" class="form-control" placeholder="อำเภอ" name="district_name"
                                   value="{{old('district_name', $district->district_name)}}" aria-describedby="basic-addon1">
                        </div>
                        <p class="card-text">
                        <div align="right">
                            <button class="w3-btn" style="background-color:#d65c00">บันทึก <i class="fa fa-save "></i>
                            </button>
                        </div>
                        <br>

                        </p>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

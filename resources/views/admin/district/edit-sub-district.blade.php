@extends('admin.layout')
@section('title', 'หน้าแก้ไขตำบล')
@section('content')
    <br>
    <div class="w3-container w3-section">
        <div class="card text-black ">
            @if($subDistrict)
                <div class="card-header bg-info mb-3"><h6><i class="fa fa-map-marked-alt fa-fw"></i> แก้ไขตำบล</h6></div>
                <form action="{{ url('subdistrict/update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col md-6">
                                <b>
                                    @if ($errors->has('district_id'))
                                        <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                    @endif
                                </b><br>
                                <div class="input-group mb-3">
                                    อำเภอ : <br>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-city fa-fw"></i></span>
                                    </div>
                                    <select class="form-control" name="district_id" placeholder="เลือกอำเภอ">
                                        @foreach($districts as $district)
                                            @if(old('district_id', '') ==  '')
                                                <option value="{{ $district->district_id }}"
                                                @if($district->district_id == $subDistrict->district_id) {{ 'selected' }} @endif>
                                                    {{ $district->district_name }}
                                                </option>
                                            @elseif(old('district_id', '') !=  '')
                                                <option value="{{ $district->district_id }}" @if(old('district_id') == $district->district_id) {{ 'selected' }} @endif>
                                                    {{ $district->district_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col md-6">
                                <b>
                                    @if ($errors->has('subdistrict_name'))
                                        <span class="text-danger">{{ $errors->first('subdistrict_name') }}</span>
                                    @endif
                                </b><br>
                                <div class="input-group mb-3">
                                    ตำบล : <br>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-map-marked-alt  fa-fw"></i></span>
                                    </div>
                                    <input type="hidden" name="subdistrict_id" value="{{$subDistrict->subdistrict_id}}">
                                    <input type="text" class="form-control" placeholder="ตำบล" name="subdistrict_name"
                                           value="{{old('subdistrict_name', $subDistrict->subdistrict_name)}}" aria-describedby="basic-addon1">
                                </div>
                            </div>
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
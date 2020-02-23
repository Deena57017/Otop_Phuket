{{-- หน้าเพิ่มอำเภอและตำบล ฝั่งผู้ดูแลระบบ --}}
<style media="screen">
    .table-wrapper-scroll-y {
        display: block;
        max-height: 270px;
        overflow-y: auto;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
</style>
@extends('admin.layout')
@section('title', 'หน้าตำบล')
@section('content')
    <div class="w3-container w3-section">
        <div align="right">
            <a href="{{ url('district') }}" class="w3-btn" style="background-color:red; color:white">กลับไปยังหน้าเพิ่มอำเภอ
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <br>
        <div class="card text-black ">
            <div class="card-header bg-info mb-3"><h6><i class="fa fa-map-marked-alt fa-fw"></i> เพิ่มตำบล</h6></div>
            <form action="{{ url('subdistrict/add') }}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col md-6">
                            <b>
                                @if ($errors->has('district_id'))
                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                @else(session()->has('success'))
                                    <span class="text-success">{{ session()->get('success') }}</span>
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
                                        <option value="{{ $district->district_id }}" @if(old('district_id') == $district->district_id) {{ 'selected' }} @endif>
                                            {{ $district->district_name }}
                                        </option>
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
                                <input type="text" class="form-control" placeholder="ตำบล" name="subdistrict_name"
                                       value="{{ old('subdistrict_name') }}" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <p class="card-text">
                    <div align="right">
                        <button class="w3-btn" style="background-color:#8ad633">บันทึก <i class="fa fa-save "></i>
                        </button>
                    </div>
                    <br>
                    </p>
                </div>
            </form>
        </div>
        <br><br>
        @if(isset($subDistricts))
            @if(session()->has('fail'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle">
                        <b class="text-danger">{{ session()->get('fail') }}</b>
                    </i>
                </div>
            @endif
            <div class="table-wrapper-scroll-y">
                <table class="table table-bordered table-dark">
                    <thead>
                    <td colspan="5"><h6>ตำบล</h6>
                    </td>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อตำบล</th>
                        <th scope="col">ชื่ออำเภอ</th>
                        <th colspan="2" width="20%" scope="col">ตัวเลือก</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subDistricts as  $index => $subDistrict)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            <td>{{ $subDistrict->subdistrict_name }}</td>
                            <td>{{ $subDistrict->district_name }}</td>
                            <td>
                                <form action="{{url('subdistrict/edit')}}/{{$subDistrict->subdistrict_id}}" method="GET">
                                    <button class="btn btn-warning btn-xs">
                                        <i class="fa fa-edit fa-fw"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{url('subdistrict/delete')}}/{{$subDistrict->subdistrict_id}}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-alt fa-fw" onclick="return confirm('คุณต้องการลบอำเภอ {{$district->district_name}} ?')"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <hr>
    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
        <h4>FOOTER</h4>
        <p>Powered by w3.css</p>
    </footer>
@endsection

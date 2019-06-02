@extends('admin.layout.index')

@section('content')
    <<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12" style="padding-top:30px">
                    <a href="http://localhost:8888/taoqrcode/public/admin/danhsach" class="btn btn-default" style="background-color: #f7f7f7"><i class="fa fa-angle-left fa-fw"></i>QUAY LẠI</a>
                </div>
                <div class="col-lg-12">
                    <h1 class="page-header">{{$TenSP}}</h1>
                </div>
                <!-- /.col-lg-12 -->

                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                @if(session('canhbao'))
                    <div class="alert alert-warning">
                        {{session('canhbao')}}
                    </div>
                @endif

                @foreach($stt_losx as $stt)
                    <div class="col-lg-12" style="padding-bottom: 20px">
                        <h4 style="padding-bottom: 20px">{{$TenDL[$stt->MaDL]}}
                            <a href="http://localhost:8888/taoqrcode/public/admin/inma/{{$stt->MaLo}}/{{$stt->MaSP}}/{{$stt->MaDL}}" class="btn btn-default" target="_blank">IN MÃ</a>
                        </h4>
                        @foreach($image[$stt->MaDL] as $img)
                            @if($img == null) <p style="color: grey"> * Mã QR Code đã được in</p>
                            @else <img src="http://localhost:8888/taoqrcode/public/{{$img}}" onclick="window.open('http://localhost:8888/taoqrcode/public/admin/inma/stt/{{$stt->MaLo}}/{{$stt->MaSP}}/{{$stt->MaDL}}/{{basename($img)}}')">
                            @endif
                        @endforeach
                    </div>
                @endforeach

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

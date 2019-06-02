@extends('admin.layout.index')

@section('content')
    <<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Sách</h1>
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

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>Mã Lô</th>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>SĐK</th>
                        <th>Hình ảnh</th>
                        <th>NSX</th>
                        <th>HSD</th>
                        <th>SL</th>
                        <th>Tạo Mã</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sp_losx as $sp)
                        <tr class="odd gradeX" align="center" onclick="document.location='/admin/taoma/{{$sp->MaLo}}/{{$sp->MaSP}}'">
                            <td>{{$sp->MaLo}}</td>
                            <td>{{$sp->MaSP}}</td>
                            <td>{{$sp->motsanpham->TenSP}}</td>
                            <td>{{$sp->motsanpham->SDK}}</td>
                            <td>
                                <img width="100px" src="http://149.28.137.5/upload/sanpham/{{$sp->motsanpham->HinhAnh}}"/>
                            </td>
                            <td>{{$sp->NSX->format('d/m/Y')}}</td>
                            <td>{{$sp->HSD->format('d/m/Y')}}</td>
                            <td>{{$sp->SoLuong}}</td>
                            <td><i class="fa fa-qrcode fa-fw"></i><a href="/admin/taoma/{{$sp->MaLo}}/{{$sp->MaSP}}">Tạo Mã</a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('script')

@endsection

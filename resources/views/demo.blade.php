@extends('admin.layout.index')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">In mã QR CODE
                        <small></small>
                    </h1>
                </div>

                <div class="col-lg-12">
                    <form action="demo" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input id="HinhAnh" type="file"accept="image/*" class="form-control sanpham" name="HinhAnh" placeholder="Nhập hình ảnh" />
                        </div>
                        <input type="submit" value="Thêm">
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        function VoucherSourcetoPrint(source) {
            return "<html><head><script>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()'>\n" +
                "<img src='" + source + "' /></body></html>";
        }
        function VoucherPrint(source) {
            Pagelink = "about:blank";
            var pwa = window.open(Pagelink, "_new");
            pwa.document.open();
            pwa.document.write(VoucherSourcetoPrint(source));
            pwa.document.close();
        }
    </script>
    <style type="text/css">
        .myButton
        {
            background-color: #77b55a;
            border: 1px solid #4b8f29;
            display: inline-block;
            cursor: pointer;
            color: #f0ebf0;
            font-family: arial;
            font-size: 13px;
            font-weight: bold;
            margin: 5px;
            padding: 7px 35px;
            text-decoration: none;
        }
    </style>
@endsection

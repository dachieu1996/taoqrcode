<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo QR CODE</title>



    <!-- Bootstrap Core CSS -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    @include('admin.layout.header')

    <!-- Page Content -->
    @yield('content')
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="http://localhost:8888/taoqrcode/public/admin_asset/dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="http://localhost:8888/taoqrcode/public/admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "language": {

                "search": "Tìm Kiếm:",
                "emptyTable":     "",
                "info":           "Hiển thị từ _START_ đến _END_ của _TOTAL_ hàng",
                "infoEmpty":      "Hiển thị từ 0 đến 0 của 0 hàng",
                "lengthMenu":     "Hiển thị _MENU_ hàng",
                "zeroRecords":    "",
                "paginate": {
                    "first":      "Đầu tiên",
                    "last":       "Cuối cùng",
                    "next":       "Sau",
                    "previous":   "Trước"
                },

            }
        });
    });
</script>

@yield('script')

</body>

</html>

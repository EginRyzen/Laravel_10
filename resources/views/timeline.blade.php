<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Timeline</title>

    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- AdminLTE css -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <!-- Site wrapper -->
    <div class="">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ml-0">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">{{ Auth::user()->username }}</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" data-toggle="modal" data-target="#upload"
                        class="nav-link btn btn-primary btn-sm text-white">Upload foto</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link" role="button">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <div class="modal fade" id="upload">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload form</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('uploadfoto') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="judul">Judul :</label>
                            <input type="text" id="judul" name="judul" class="form-control" required>
                            <label for="deskripsi">Deskripsi :</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control" required>
                            <label for="foto">Foto :</label>
                            <input type="file" id="foto" name="foto" class="form-control" required>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Timeline</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Timeline</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- Timelime example  -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-red">Timeline galeri anda</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">{{ Auth::user()->username }}
                                                |</a>
                                            Upload an terbaru anda
                                        </h3>
                                        <div class="timeline-body">
                                            @foreach ($galeri as $g)
                                                <img src="{{ asset('foto/' . $g->foto) }}" alt=". . ."
                                                    class="img-fluid" width="150" height="100">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                @foreach ($galeri as $gl)
                                    <div>
                                        <i class="fas fa-camera bg-maroon"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i
                                                    class="fas fa-clock"></i>{{ $gl->created_at->diffForHumans() }}</span>

                                            <h3 class="timeline-header"><a href="#">{{ $gl->judul }} |</a>
                                                <a href="" data-toggle="modal"
                                                    data-target="#edit{{ $gl->id }}" class="btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>
                                                <div class="modal fade" id="edit{{ $gl->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit form</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ url('editfoto/' . $gl->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <label for="judul">Judul :</label>
                                                                    <input type="text" id="judul"
                                                                        name="judul" class="form-control"
                                                                        value="{{ $gl->judul }}" required>
                                                                    <label for="deskripsi">Deskripsi :</label>
                                                                    <input type="text" id="deskripsi"
                                                                        name="deskripsi" class="form-control"
                                                                        value="{{ $gl->deskripsi }}" required>
                                                                    <label for="foto">Foto :</label>
                                                                    <input type="file" id="foto"
                                                                        name="foto" class="form-control" required>
                                                                    <span class="text-danger">* Jika tidak ingin
                                                                        dirubah,tidak perlu diisi</span>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-warning">Edit</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <a href="" data-toggle="modal"
                                                    data-target="#hapus{{ $gl->id }}" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></a>
                                                <div class="modal fade" id="hapus{{ $gl->id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus form</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ url('hapusfoto/' . $gl->id) }}"
                                                                method="get" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <span class="text-danger">Yakin ingin menghapus
                                                                        "{{ $gl->judul }}"?</span>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </h3>

                                            <div class="timeline-body">
                                                <div class="embed-responsive">
                                                    <img src="{{ asset('foto/' . $gl->foto) }}" alt=". . ."
                                                        class="img-fluid" width="250" height="200">
                                                </div>
                                            </div>
                                            <div class="timeline-footer">
                                                <p>{{ $gl->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- END timeline item -->
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.timeline -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
</body>

</html>

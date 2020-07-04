@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Data Pengguna</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="/admin">Home</a></li>
               <li class="breadcrumb-item active">Data Pengguna</li>
            </ol>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header container-fluid">
                  <div class="row">
                     <div class="col-md-10">
                        <h3 class="card-title">Data Pengguna</h3>
                     </div>
                     <div class="col-md-2">
                        <a href="/admin/pengguna-tambah" class="btn btn-primary float-right">Tambah Data</a>
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="dataTables" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Username</th>
                           <th>Nama lengkap</th>
                           <th>Telp</th>
                           <th>Email</th>
                           <th>Jabatan</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($pengguna as $o)
                        <tr>
                           <td>{{ $o->username }}</td>
                           <td>{{ $o->nama }}</td>
                           <td>{{ $o->telp }}</td>
                           <td>{{ $o->email }}</td>
                           <td>{{ $o->level }}</td>
                           <td>
                              <a href="/admin/pengguna-edit/{{ $o->id }}" class="btn btn-warning">Edit</a>
                              <a href="/admin/pengguna-hapus/{{ $o->id }}" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Hapus</a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>
<script>
   $(function () {

     $('#dataTables').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "responsive": true,
     });
   });
</script>
@endsection

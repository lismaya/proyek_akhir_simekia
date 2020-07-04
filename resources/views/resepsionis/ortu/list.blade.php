@extends('resepsionis.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Data Orangtua</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="/resepsionis">Home</a></li>
               <li class="breadcrumb-item active">Data Orangtua</li>
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
                        <h3 class="card-title">Data Orangtua</h3>
                     </div>
                     <div class="col-md-2">
                        <a href="/resepsionis/ortu-tambah" class="btn btn-primary float-right">Tambah Data</a>              
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="dataTables" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Username</th>
                           <th>Nama Ayah</th>
                           <th>Nama Ibu</th>
                           <th>Alamat</th>
                           <th>Telp</th>
                           <th>Email</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($ortu as $o)
                        <tr>
                           <td>{{ $o->username }}</td>
                           <td>{{ $o->nama_ayah }}</td>
                           <td>{{ $o->nama_ibu }}</td>
                           <td>{{ $o->alamat }}</td>
                           <td>{{ $o->telp }}</td>
                           <td>{{ $o->email }}</td>
                           <td>
                              <a href="/resepsionis/pasien/{{ $o->id }}" class="btn btn-success">{{ $o->pasien->count() }}&nbsp;Anak</a>
                              <a href="/resepsionis/ortu-edit/{{ $o->id }}" class="btn btn-warning">Edit</a>
                              <a href="/resepsionis/ortu-hapus/{{ $o->id }}" class="btn btn-danger">Hapus</a>
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
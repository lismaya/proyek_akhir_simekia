@extends('resepsionis.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Data Pasien</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/resepsionis">Home</a></li>
              <li class="breadcrumb-item"><a href="/resepsionis/ortu">Data Orangtua</a></li>
              <li class="breadcrumb-item active">Data Pasien</li>
              
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
                        <h3 class="card-title">Data Pasien</h3>
                     </div>
                     <div class="col-md-2">
                        <a href="/resepsionis/pasien-tambah/{{ $ortu_id }}" class="btn btn-primary float-right">Tambah Data</a>              
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="dataTables" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Nama</th>
                           <th>Jenis Kelamin</th>
                           <th>Tempat Lahir</th>
                           <th>Tanggal Lahir</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($pasien as $o)
                        <tr>
                           <td>{{ $o->nama }}</td>
                           <td>{{ ($o->jk === 'L') ? 'Laki-laki' : 'Perempuan'  }}</td>
                           <td>{{ $o->tempat_lahir }}</td>
                           <td>{{ $o->tgl_lahir . ' (' . $o->usia . ')' }}</td>                           
                           <td>                              
                              <a href="/resepsionis/pasien-edit/{{ $ortu_id}}/{{ $o->id }}" class="btn btn-warning">Edit</a>
                              <a href="/resepsionis/pasien-hapus/{{ $ortu_id}}/{{ $o->id }}" class="btn btn-danger">Hapus</a>
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
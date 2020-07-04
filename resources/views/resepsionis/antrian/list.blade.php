@extends('resepsionis.layout')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Data Antrian</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="/resepsionis">Home</a></li>
               <li class="breadcrumb-item active">Data Antrian</li>
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
                        <h3 class="card-title">Data Antrian</h3>
                     </div>
                     <div class="col-md-2">
                        <a href="#!" data-toggle="modal" data-target="#pasienModal" class="btn btn-primary float-right">Tambah Data</a>              
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="dataTables" class="table table-bordered table-striped">
                     <thead>
                        <tr>                           
                           <th>Jenis</th>
                           <th>Nama Pasien</th>
                           <th>Tanggal Lahir</th>
                           <th>Nama Orangtua</th>
                           <th>Alamat</th>                           
                           <th>Antropometri</th>                           
                           <th>Opsi</th>
                        </tr>
                     </thead>
                     <tbody id="table-antrian-body">                       
                        @foreach($antrian as $a)
                        <tr>
                           @if($a->jenis === 'pemeriksaan')
                           <td>
                              <span class="badge badge-success">{{ strtoupper($a->jenis) }}</span>                              
                            </td>
                           @else
                           <td><span class="badge badge-warning">{{ strtoupper($a->jenis) }}</span></td>
                           @endif 
                           
                           <td>{{ $a->nama }}</td>
                           <td>{{ $a->tgl_lahir }}</td>
                           <td>{{ $a->ortu }}</td>
                           <td>{{ $a->alamat }}</td>
                           <td>
                             <a href="#!" onClick="$('#antropometri_pasien_id').val({{ $a->pasien_id }})" data-toggle="modal" data-target="#antropometriModal">Ukur</a>
                           </td>
                           <td>
                             @if($a->status === 'antri')
                             <a href="/resepsionis/set-diperiksa/{{ $a->id }}" class="btn btn-warning btn-sm">DI TANGANI</a>
                             @else
                             <span class="badge badge-warning">DALAM PENANGANAN</span>
                             @endif
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

<div class="modal fade" id="pasienModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah pasien antrian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="users-table" style="width:100%">
            <thead>
               <tr>                        
                   <th>Nama</th>
                   <th>Jenis Kelamin</th>
                   <th>Tempat Lahir</th>
                   <th>Tanggal Lahir</th>  
                  <th>Opsi</th>
               </tr>
            </thead>
          </table>
      </div>
      
    </div>
  </div>
</div>
<script>

   (function worker() {
      $.ajax({
        url: "/resepsionis/antrian-ajax",
        success: function(data) {
          $('#table-antrian-body').html(data.html);
        },
        complete: function() {
          setTimeout(worker, 5000);
        }
      });
    })();

   $(function () {
     
     $('#dataTables').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": true,
       "ordering": false,
       "info": true,
       "autoWidth": false,
       "responsive": true,
     });
   });

   $('#users-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: 'data-pasien-json',
          columns: [
              
              { data: 'nama', name: 'nama' },
              { data: 'jk', name: 'jk' },
              { data: 'tempat_lahir', name: 'tempat_lahir' },
              { data: 'tgl_lahir', name: 'tgl_lahir' },
              { data: 'id', name:'id'},
          ],
          "columnDefs": [
             {
               //<a href="#" class="detail" id="1671070911900008" onclick="show_detail('1671070911900008')">BELA RONALDOE</a>
               "render": function(data,type,row){
                 return '<a href="/resepsionis/tambah-data-antrian/' + row['id'] + '/000" class="detail btn btn-success">Pemeriksaan</a>&nbsp;|&nbsp;<a href="/resepsionis/tambah-data-antrian/' + row['id'] + '/111" class="detail btn btn-warning">Imunisasi</a>';
               },
               "targets" : 4
             },
             {
                "render": function(data,type,row){
                 return row['jk'] == 'L' ? 'Laki-laki' : 'Perempuan';
               },
               "targets" : 1  
             }
           ]
      });
</script>
@endsection
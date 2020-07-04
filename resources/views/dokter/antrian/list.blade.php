@extends('dokter.layout')
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
               <li class="breadcrumb-item"><a href="/dokter">Home</a></li>
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
                           <th>Riwayat Kesehatan</th>
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
                              <a href="#!" onClick="showRiwayatPemeriksaan({{ $a->pasien_id }})"><span class="btn btn-success btn-xs btn-block" style="margin-bottom: 5px">Pemeriksaan</span></a>
                              <a href="#!" onClick="showRiwayatImunisasi({{ $a->pasien_id }})"><span class="btn btn-warning btn-xs btn-block" style="margin-bottom: 5px">Imunisasi</span></a>
                              <a href="#!" onClick="showRiwayatAntropometri({{ $a->pasien_id }})"><span class="btn btn-info btn-xs btn-block">Antropometri</span></a>
                           </td>
                           <td>
                              @if($a->jenis === 'imunisasi')
                              <a href="#!" onClick="showFormImunisasi({{ $a->pasien_id }})" class="btn btn-warning btn-sm">Form Imunisasi</a>
                              @else
                              <a href="#!" onClick="showFormPemeriksaan({{ $a->pasien_id }})" class="btn btn-warning btn-sm">Form Pemeriksaan</a>     
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
<script>
   (function worker() {
      $.ajax({
        url: "/dokter/antrian-ajax",
        success: function(data) {
          $('#table-antrian-body').html(data.html);
        },
        complete: function() {
          setTimeout(worker, 5000);
        }
      });
    })();
   
    function showFormImunisasi(pasien_id){
      $.ajax({
          url:"/dokter/form-imunisasi-ajax/" + pasien_id,
          success: function(data){
            $('#formImunisasi form .card-body').html(data.html);
           
          }
      });
   
      $('#formImunisasi').modal('show');
      $('#formImunisasi form').attr('action','/dokter/imunisasi-simpan/' + pasien_id);
    }
   
    function showFormPemeriksaan(pasien_id){
      $('#formPemeriksaan').modal('show');
      $('#formPemeriksaan form').attr('action','/dokter/pemeriksaan-simpan/' + pasien_id);
    }
   
   
    function showRiwayatPemeriksaan(pasien_id){
      $.ajax({
          url:"/dokter/riwayat-pemeriksaan-ajax/" + pasien_id,
          success: function(data){
            $('#riwayatModal .modal-body').html(data.html);
           
          }
      });
   
      $('#riwayatModal').modal('show');
    }
   
    function showRiwayatImunisasi(pasien_id){
      $.ajax({
          url:"/dokter/riwayat-imunisasi-ajax/" + pasien_id,
          success: function(data){
            $('#riwayatModal .modal-body').html(data.html);
           
          }
      });
   
      $('#riwayatModal').modal('show');
    }
   
   function showRiwayatAntropometri(pasien_id){
   $.ajax({
          url:"/dokter/riwayat-antropometri-ajax/" + pasien_id,
          success: function(data){
            $('#riwayatModal .modal-body').html(data.html);
           
          }
      });
   
      $('#riwayatModal').modal('show');
    }
   
   
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
</script>
<div class="modal fade" id="riwayatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Riwayat Kesehatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formImunisasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pencatatan Data Imunisasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form role="form" method="POST" action="">
               {{ csrf_field() }}
               <input type="hidden" name="pasien_id" id="imunisasi_pasien_id" value="">
               <div class="card-body">
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="formPemeriksaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pencatatan Data Pemeriksaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form role="form" method="POST" action="">
               {{ csrf_field() }}
               <input type="hidden" name="pasien_id" id="imunisasi_pasien_id" value="">
               <div class="card-body">
                  <div class="form-group">
                     <label>Anamnesa</label>
                     <textarea class="form-control" name="anamnesa" required="">{{ old('anamnesa') }}</textarea>
                     @if($errors->has('anamnesa'))
                     <div class="text-danger">
                        {{ $errors->first('anamnesa')}}
                     </div>
                     @endif      
                  </div>
                  <div class="form-group">
                     <label>Diagnosa</label>
                     <textarea class="form-control" name="diagnosa" required="">{{ old('diagnosa') }}</textarea>
                     @if($errors->has('diagnosa'))
                     <div class="text-danger">
                        {{ $errors->first('diagnosa')}}
                     </div>
                     @endif      
                  </div>
                  <div class="form-group">
                     <label>Tindakan</label>
                     <textarea class="form-control" name="tindakan" required="">{{ old('tindakan') }}</textarea>
                     @if($errors->has('tindakan'))
                     <div class="text-danger">
                        {{ $errors->first('tindakan')}}
                     </div>
                     @endif      
                  </div>
                  <div class="form-group">
                     <label>Resep</label>
                     <textarea class="form-control" name="resep">{{ old('resep') }}</textarea>
                     @if($errors->has('resep'))
                     <div class="text-danger">
                        {{ $errors->first('resep')}}
                     </div>
                     @endif      
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
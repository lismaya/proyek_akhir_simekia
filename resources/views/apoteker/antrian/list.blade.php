@extends('apoteker.layout')
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
               <li class="breadcrumb-item"><a href="/apoteker">Home</a></li>
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
                           <th>Nama Pasien</th>
                           <th>Tanggal Lahir</th>
                           <th>Nama Orangtua</th>
                           <th>Alamat</th>
                           <th>Resep</th>
                           <th>Opsi</th>
                        </tr>
                     </thead>
                     <tbody id="table-antrian-body">
                        @foreach($antrian as $a)
                        <tr>
                           <td>{{ $a->nama }}</td>
                           <td>{{ $a->tgl_lahir }}</td>
                           <td>{{ $a->ortu }}</td>
                           <td>{{ $a->alamat }}</td>
                           <td>
                              <a href="#!" onClick="showResep({{ $a->pasien_id . ",'" . $a->jenis . "'"   }})"><span class="btn btn-success btn-xs btn-block" style="margin-bottom: 5px">Detail</span></a>
                           </td>
                           <td>
                              <a href="/resepsionis/set-selesai/{{ $a->id }}" class="btn btn-warning btn-sm">Selesai</a>
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
        url: "/apoteker/antrian-ajax",
        success: function(data) {
          $('#table-antrian-body').html(data.html);
        },
        complete: function() {
          setTimeout(worker, 5000);
        }
      });
    })();
   
  function showResep(pasien_id,jenis){
   $.ajax({
          url:"/apoteker/detail-resep-ajax/" + pasien_id + '/' + jenis,
          success: function(data){
            $('#resepModal .modal-body').html(data.html);
           
          }
      });
   
      $('#resepModal').modal('show');
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
<div class="modal fade" id="resepModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Resep</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         </div>
      </div>
   </div>
</div>

@endsection
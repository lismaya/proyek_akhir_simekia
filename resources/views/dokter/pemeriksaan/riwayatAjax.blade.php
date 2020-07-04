<table id="dataTablesRiwayat" class="table table-bordered table-striped">
 <thead>
    <tr>
       <th>Tanggal</th>
       <th>Usia</th>
       <th>Anamnesa</th>
       <th>Diagnosa</th>
       <th>Tindakan</th>
       <th>Resep</th>
    </tr>
 </thead>
 <tbody id="table-antrian-body">
    @foreach($riwayat as $a)
    <tr>
       <td>{{ $a->tgl }}</td>
       <td>{{ $a->usia }}&nbsp;Bulan</td>
       <td>{{ $a->anamnesa }}</td>
       <td>{{ $a->diagnosa }}</td>
       <td>{{ $a->tindakan }}</td>
       <td>{{ $a->resep }}</td>
     </tr>
    @endforeach
 </tbody>
</table>

<script type="text/javascript">
	$(function () {     
	     $('#dataTablesRiwayat').DataTable({
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
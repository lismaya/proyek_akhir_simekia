<table id="dataTablesRiwayat" class="table table-bordered table-striped">
 <thead>
    <tr>
       <th>Tanggal</th>
       <th>Usia</th>
       <th>Berat badan</th>
       <th>Tinggi badan</th>
       <th>Lingkar kepala</th>
    </tr>
 </thead>
 <tbody id="table-antrian-body">
    @foreach($riwayat as $a)
    <tr>
       <td>{{ $a->tgl }}</td>
       <td>{{ $a->usia }}&nbsp;Bulan</td>
       <td>{{ $a->bb }}&nbsp;Kg</td>
       <td>{{ $a->tb }}&nbsp;Cm</td>
       <td>{{ $a->lk }}&nbsp;Cm</td>
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
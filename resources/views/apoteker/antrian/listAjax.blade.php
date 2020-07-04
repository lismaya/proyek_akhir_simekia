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
      <a href="/apoteker/set-selesai/{{ $a->id }}" class="btn btn-warning btn-sm">Selesai</a>
   </td>
</tr>
@endforeach
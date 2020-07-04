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
      <a href="#!" onClick="showRiwayatAntropometri({{ $a->pasien_id }})"><span class="btn btn-info btn-xs btn-block">Antropometri</span></a>  </td>
   <td>
     @if($a->jenis === 'imunisasi')
     <a href="#!" onClick="showFormImunisasi({{ $a->pasien_id }})" class="btn btn-warning btn-sm">Form Imunisasi</a>
     @else
     <a href="#!" onClick="showFormPemeriksaan({{ $a->pasien_id }})" class="btn btn-warning btn-sm">Form Pemeriksaan</a>     
     @endif
   </td>
</tr>
@endforeach
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
      @if($a->pemeriksaan_antropometri == 0)
       <a href="#!" onClick="$('#antropometri_pasien_id').val({{ $a->pasien_id }})" data-toggle="modal" data-target="#antropometriModal">Ukur</a>
      @else
       <span class="badge badge-info">SUDAH DIUKUR</span>
      @endif 
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
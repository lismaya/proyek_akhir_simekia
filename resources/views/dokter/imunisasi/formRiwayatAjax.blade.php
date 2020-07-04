<div class="form-group">
  <label>Jenis Imunisasi</label>
  <select class="form-control" name="jenis_imunisasi_id" required="">
    @foreach($jenis_imunisasi as $ji)
      <option value="{{ $ji->id }}">{{ $ji->nama }}</option>
    @endforeach        
  </select>
  @if($errors->has('level'))
        <div class="text-danger">
            {{ $errors->first('jenis_imunisasi_id')}}
        </div>
   @endif                    
</div>
<div class="form-group">
  <label>Jadwal Imunisasi selanjutnya</label>
  <div class="input-group" id="jadwal_imunisai_selanjutnya" data-target-input="nearest">
      <input type="text" class="form-control" data-target="#jadwal_imunisai_selanjutnya" name="jadwal_imunisai_selanjutnya" value="{{ old('jadwal_imunisai_selanjutnya') }}"/>
      <div class="input-group-append" data-target="#jadwal_imunisai_selanjutnya" data-toggle="datetimepicker">
          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
      </div>
  </div>
  @if($errors->has('jadwal_imunisai_selanjutnya'))
        <div class="text-danger">
            {{ $errors->first('jadwal_imunisai_selanjutnya')}}
        </div>
   @endif      
</div>
<div class="form-group">
  <label>Resep Obat</label>
  <textarea name="resep" class="form-control"></textarea>
</div>
<div class="form-group">
  <label>Keterangan</label>
  <textarea name="keterangan" class="form-control"></textarea>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="tahun_input">TAHUN INPUT</label>
        <input type="text" name="tahun_input" class="form-control datepicker2" placeholder="Tahun Input" data-date-format="yyyy" value="{{ $poverty->tahun_input ?? '' }}">
        @error('tahun_input') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="tinggi_pondasi_rumah">TINGGI PONDASI RUMAH</label>
        <input type="text" name="tinggi_pondasi_rumah" class="form-control" placeholder="Tinggi Pondasi Rumah" value="{{ $poverty->tinggi_pondasi_rumah ?? '' }}">
        @error('tinggi_pondasi_rumah') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="jumlah_jiwa">JUMLAH JIWA DIDALAM RUMAH</label>
        <input type="number" name="jumlah_jiwa" class="form-control" placeholder="Jumlah Jiwa Didalam Rumah" value="{{ $poverty->jumlah_jiwa ?? '' }}">
        @error('jumlah_jiwa') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="luas_ruangan">LUAS RUANGAN RUMAH <span class="text-xs">(meter persegi)</span></label>
        <input type="text" name="luas_ruangan" class="form-control" placeholder="Luas Ruangan"  value="{{ $poverty->luas_ruangan ?? '' }}">
        @error('luas_ruangan') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6 form-group">
    <label for="kondisi_rumah">Lingkungan dan Kondisi Hunian</label>
    <select name="kondisi_rumah" class="form-select" id="kondisi_rumah">
        <option selected value="">Pilih Lingkungan dan Kondisi Hunian</option>
        <option value="RAWAN BANJIR" @if(isset($poverty) && $poverty->kondisi_rumah === 'RAWAN BANJIR') selected @endif>RAWAN BANJIR</option>
        <option value="RAWAN LONGSOR" @if(isset($poverty) && $poverty->kondisi_rumah === 'RAWAN LONGSOR') selected @endif>RAWAN LONGSOR</option>
        <option value="LAINNYA" @if(isset($poverty) && $poverty->kondisi_rumah === 'LAINNYA') selected @endif>LAINNYA</option>
    </select>
    @error('kondisi_rumah') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>
@push('js')
<script>
    $(document).ready(function () {
        $('.datepicker2').datepicker({
            format: 'yyyy',
            startView: 'years',
            minViewMode: 'years',
            autoclose: true
        });
    });

</script>
@endpush

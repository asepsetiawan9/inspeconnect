<div class="col-md-6 form-group">
    <label for="desil">DESIL</label>
    <select name="desil" class="form-select" id="desil">
        <option selected value="">Pilih Desil</option>
        <option value="DESIL 1" @if(isset($poverty) && $poverty->desil === 'DESIL 1') selected @endif>DESIL 1</option>
        <option value="DESIL 2" @if(isset($poverty) && $poverty->desil === 'DESIL 2') selected @endif>DESIL 2</option>
        <option value="DESIL 3" @if(isset($poverty) && $poverty->desil === 'DESIL 3') selected @endif>DESIL 3</option>
        <option value="DESIL 4" @if(isset($poverty) && $poverty->desil === 'DESIL 4') selected @endif>DESIL 4</option>
    </select>
    @error('desil') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>
<div class="col-md-6 form-group">
    <label for="dtks">TERDAPTAR DTKS ?</label>
    <select name="dtks" class="form-select" id="dtks">
        <option selected value="">Pilih DTKS</option>
        <option value="YA" @if(isset($poverty) && $poverty->dtks === 'YA') selected @endif>YA</option>
        <option value="TIDAK" @if(isset($poverty) && $poverty->dtks === 'TIDAK') selected @endif>TIDAK</option>
    </select>
    @error('dtks') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="penghasilan_perbulan">PENGHASILAN PERBULAN</label>
        <input type="number" id="penghasilan_perbulan" name="penghasilan_perbulan" class="form-control"
            placeholder="Masukan Penghasilan Perbulan" value="{{ $poverty->penghasilan_perbulan ?? '' }}">
        @error('penghasilan_perbulan') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label for="bantuan_diterima">BANTUAN YANG DITERIMA </label>
        <textarea id="bantuan_diterima" name="bantuan_diterima" class="form-control" rows="5"
            placeholder="Masukkan Bantuan Yang Diterima" >{{ $poverty->bantuan_diterima ?? '' }}</textarea>
        @error('bantuan_diterima') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="tahun_input">TAHUN INPUT</label>
        <input type="text" name="tahun_input" class="form-control datepicker2" placeholder="Tahun Input" data-date-format="yyyy" value="{{ $poverty->tahun_input ?? '' }}">
        @error('tahun_input') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
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

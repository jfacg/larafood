@include('admin.includes.alerts')

<div class="form-group">
  <label>Mesa:</label>
  <input type="text" name="identify" class="form-control" placeholder="Mesa:" value="{{$table->identify ?? old('identify')}}">
</div>
<div class="form-group">
  <label>Descrição:</label>
  <input type="text" name="description" class="form-control" placeholder="Descrição:" value="{{$table->description ?? old('description')}}">
</div>
<div class="form-group">
  <button type="submit" class="btn btn-dark">Enviar</button>
</div>
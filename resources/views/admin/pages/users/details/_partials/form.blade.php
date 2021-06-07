@include('admin.includes.alerts')
@csrf

<div class="form-group">
  <label>Nome:</label>
  <input type="text" placeholder="nome" name="name" class="form-control" value="{{ $detail->name ?? old('')}}">
</div>
<div class="form-group">
  <button type="submit" class="btn btn-info">Enviar</button>
</div>
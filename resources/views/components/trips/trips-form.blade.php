<form class="trips-form" method="post" action="/api/addTravel">
  <div>
    <button id="btn-add-origin" class="button">Agregar origen</button>
    <button id="btn-add-destination" class="button">Agregar destino</button>
  </div>
<div>
  <div>
      @csrf
      <input name="user_id" type="text" value="{{ auth()->user()->id }}" placeholder="" hidden />
        <input name="from" type="text" value="{{ old('from') }}" id="from" placeholder="Origen" />
        @error('from')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      
      <input name="from-coords" type="hidden" value="{{ old('from-coords') }}" />
    
        <input name="to" type="text" value="{{ old('to') }}" id="to" placeholder="Destino" style="margin-top:20px;"/>
        @error('to')
        <small style="color: red;">{{ $message }}</small>
        @enderror

        <input name="indications" type="text" value="{{ old('indications') }}" id="indications" placeholder="Indicaciones"  style="margin-top:20px;"/>
        @error('indications')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </hr>
      <div style="display:flex; margin-top:30px" >
      <input name="to-coords" type="hidden" value="{{ old('to-coords') }}" />
      <div style ="width: 33%; margin-right:1%">
        <label for="number">Número de pasajeros</label>
        <input name="number" type="number" step="1" value="{{ old('number') }}" id="number" placeholder="Número de pasajeros" />
        @error('number')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>
      <div style ="width: 33%; margin-right:1%; ">
        <label for="date">Fecha</label>
        <input name="date" type="datetime-local" value="{{ old('date') }}" id="date"  />
        @error('date')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>
      <div style ="width: 33%; margin-right:1%; ">
        <label for="price">Precio</label>
        <input name="price" type="text" value="{{ old('price') }}" id="price" placeholder="Precio" />
        @error('price')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>
      </div>
    
  </div>
</div>
  <div style="display: flex; width: 100%; ">
    
    <div style="width: 50%; padding-right: 20px; margin: 0;">
      <label for="" style="margin-top:-100px;">Cliente</label>
      <button id="btn-filter-clients" class="button" style="float:right; margin-top:20px">Filtrar</button>
      <div  style="display: flex; width: 90%; ">
        <select id="filter-clients-by" name="">
          <option value="name" selected>Nombre</option>
          <option value="phone">Telefono</option>
        </select>
        <input name="filter-clients" type="text" value=""/>
      </div>
      <select id="filtered-clients" name="client-id">
      </select>
    </div>

    <div style="width: 50%; padding-right: 20px; margin: 0;">
      <label for="">Taxista</label>
      <button id="btn-filter-drivers" class="button"style="float:right; margin-top:20px; ">Filtrar</button>
      <div style="display: flex; width: 90%; "> 
        
        <select id="filter-drivers-by" name="">
          <option value="name" selected>Nombre</option>
          <option value="phone">Telefono</option>
        </select>
        <input name="filter-drivers" type="text" value=""/>
      </div>
      <select id="filtered-drivers" name="driver-id">
        <option value="name" selected>Nombre</option>
        <option value="phone">Nombre</option>
      </select>
    </div>
  </div>
  <input name="" type="submit" value="Hecho"/>
</form>


<form class="trips-form">
  <div>
    <button id="btn-add-origin" class="button">Agregar origen</button>
    <button id="btn-add-destination" class="button">Agregar destino</button>
  </div>
  <input name="from" type="text" value="" placeholder="Origen" disabled/>
  <input name="from-coords" type="" value="" placeholder="Origen" hidden/>
  <input name="to" type="text" value="" placeholder="Destino" disabled/>
  <input name="to-coords" type="" value="" placeholder="Origen" hidden/>
  <input name="number" type="text" value="" placeholder="Número de pasajeros" style="width: 260px;" />
  <input name="date" type="date" value="" placeholder="Número de pasajeros" style="width: 260px;" />
  <input name="indications" type="text" value="" placeholder="Indicaciones"/>
  <label for="">Cliente</label>
  <div>
    <button id="btn-filter-clients" class="button">Filtrar</button>
    <select id="filter-clients-by" name="">
      <option value="name">Nombre</option>
      <option value="phone">Telefono</option>
    </select>
    <input name="filter-clients" type="text" value=""/>
  </div>
  <select id="filtered-clients" name="">
    <option value="">ga</option>
  </select>
  
  <label for="">Taxista</label>
  <div>
    <button id="btn-filter-drivers" class="button">Filtrar</button>
    <select id="filter-drivers-by" name="">
      <option value="name">Nombre</option>
      <option value="phone">Telefono</option>
    </select>
    <input name="filter-drivers" type="text" value=""/>
  </div>
  <select id="filtered-drivers" name="">
    <option value="">ga</option>
  </select>
</form>

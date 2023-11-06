@extends('components.layout.driverLayout')

@push('styles')
<link href="/styles/globals.css" rel="stylesheet"/>
<link href="/styles/driver/styles.css" rel="stylesheet"/>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush
<title>Viajes en Curso</title>

@section('content')
@component('components.navbar')
<div>
  <a href="{{route('drivers.index')}}">Inicio</a>
</div>
<div>
  <a href="{{route('drivers.available')}}">Viajes disponibles</a>
</div>
<div>
  <a class="active" href="">Viajes en curso</a>
</div>
<div>
  <a href="{{route('user.logoutDriver')}}">Cerrar Sesión</a>
</div>
@endcomponent

<div class="container">
  <div class="row">
    
    @foreach($travels as $travel)
    <div class="md-column-2">
      <div class="sub-content">
        <input name="from_coords" type="text" value="{{$travel->from_coords}}" hidden/>
        <input name="to_coords" type="text" value="{{$travel->to_coords}}" hidden/>
        <button value-id="{{$travel->id}}" class="button">Terminar</button>
        <h2>Origen</h2>
        {{$travel->from}}
        <h2>Destino</h2>
        {{$travel->to}}
      </div>
    </div>
    <div class="md-column-2">
      <div class="sub-content" style="height: 100%; min-height: 200px;">
        <div id="map"></div>
      </div>
    </div>
    @endforeach
    
  </div>
  
</div>
@endsection

@push('scripts')
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3z9M3X6r5rI8mu4d_1IdEqms72ntbt9c&callback=initMap&v=weekly"
    defer
></script>
<script>
  /**
   * @license
   * Copyright 2019 Google LLC. All Rights Reserved.
   * SPDX-License-Identifier: Apache-2.0
   */
  function initMap() {
      const bounds = new google.maps.LatLngBounds();
      const markersArray = [];
      const map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 13.6929403, lng: -89.2181911 },
          zoom: 9,
      });
      // initialize services
      const geocoder = new google.maps.Geocoder();
      const service = new google.maps.DistanceMatrixService();
      // build request
      const origin1 = JSON.parse(document.querySelector('input[name="from_coords"]').value);
      const destinationA = JSON.parse(document.querySelector('input[name="to_coords"]').value);
      
      const request = {
          origins: [origin1],
          destinations: [destinationA],
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false,
      };

      // get distance matrix response
      service.getDistanceMatrix(request).then((response) => {
          // put response


          // show on map
          const originList = response.originAddresses;
          const destinationList = response.destinationAddresses;

          deleteMarkers(markersArray);

          const showGeocodedAddressOnMap = (asDestination) => {
              const handler = ({ results }) => {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  markersArray.push(
                      new google.maps.Marker({
                          map,
                          position: results[0].geometry.location,
                          label: asDestination ? "D" : "O",
                      })
                  );
              };
              return handler;
          };

          for (let i = 0; i < originList.length; i++) {
              const results = response.rows[i].elements;

              geocoder
                  .geocode({ address: originList[i] })
                  .then(showGeocodedAddressOnMap(false));

              for (let j = 0; j < results.length; j++) {
                  geocoder
                      .geocode({ address: destinationList[j] })
                      .then(showGeocodedAddressOnMap(true));
              }
          }
      });
  }

  function deleteMarkers(markersArray) {
      for (let i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
      }

      markersArray = [];
  }

  window.initMap = initMap;
</script>
<script src="/scripts/user/driver/script.js"></script>
@endpush


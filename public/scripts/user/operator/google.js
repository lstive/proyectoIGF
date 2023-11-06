/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let map;
let marker;
let geocoder;
let responseDiv;
let response;
let add;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: { lat: 13.6929403, lng: -89.2181911 },
    mapTypeControl: true,
  });
  geocoder = new google.maps.Geocoder();

  const inputText = document.createElement("input");

  inputText.type = "text";
  inputText.placeholder = "Enter a location";

  const submitButton = document.createElement("input");

  submitButton.type = "button";
  submitButton.value = "Geocode";
  submitButton.classList.add("button", "button-primary");

  const clearButton = document.createElement("input");

  clearButton.type = "button";
  clearButton.value = "Clear";
  clearButton.classList.add("button", "button-secondary");
  response = document.createElement("pre");
  response.id = "response";
  response.innerText = "";
  responseDiv = document.createElement("div");
  responseDiv.id = "response-container";
  responseDiv.appendChild(response);

  const instructionsElement = document.createElement("p");

  instructionsElement.id = "instructions";
  instructionsElement.innerHTML =
    "<strong>Instructions</strong>: Enter an address in the textbox to geocode or click on the map to reverse geocode.";
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(inputText);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(submitButton);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(clearButton);


  marker = new google.maps.Marker({
    map,
  });
  map.addListener("click", (e) => {
    geocode({ location: e.latLng });
  });
  submitButton.addEventListener("click", () =>
    geocode({ address: inputText.value })
  );
  clearButton.addEventListener("click", () => {
    clear();
  });
  clear();
}

function clear() {
  marker.setMap(null);
}

function geocode(request) {
  clear();
  geocoder
    .geocode(request)
    .then((result) => {
      const { results } = result;

      map.setCenter(results[0].geometry.location);
      marker.setPosition(results[0].geometry.location);
      marker.setMap(map);
      response.innerText = JSON.stringify(result, null, 2);

      req = JSON.parse(JSON.stringify(result, null, 2))
      add = req.results[0].geometry.location
      
      //add_2 = req.results[0].address_components[1].long_name + ", " + req.results[0].address_components[2].long_name + ", " + req.results[0].address_components[3].long_name
      add_2 = " "+req.results[0].formatted_address
      return results;
    })
    .catch((e) => {
      alert("Geocode was not successful for the following reason: " + e);
    });
}

document.getElementById('btn-add-origin').addEventListener('click', event => {
  event.preventDefault()
  document.querySelector('input[name="from-coords"]').value = JSON.stringify(add)
  document.querySelector('input[name="from"]').value = add_2
  console.log(response)
})

document.getElementById('btn-add-destination').addEventListener('click', event => {
  event.preventDefault()
  document.querySelector('input[name="to-coords"]').value = JSON.stringify(add)
  document.querySelector('input[name="to"]').value = add_2
  console.log(req.results)
})

document.getElementById('btn-filter-clients').addEventListener('click', event => {
  event.preventDefault();

  (async () => {
    let filteredClients = document.getElementById('filtered-clients')
    let filterBy = document.getElementById('filter-clients-by').value
    let filter = document.querySelector('input[name="filter-clients"]').value

    const req = {
      filterBy,
      filter
    }

    const res = await fetch('/api/filterClients', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(req)
    })

    const query = await res.json()
    console.log(query)

    filteredClients.innerHTML = ''
    let htmlCode = ''
    let x = 2
    query.forEach(client => {
      htmlCode += `<option value="${client.id}">${client.name}</option>`
    })

    filteredClients.innerHTML = htmlCode
  })();
})

document.getElementById('btn-filter-drivers').addEventListener('click', event => {
  event.preventDefault();

  (async () => {
    let filteredClients = document.getElementById('filtered-drivers')
    let filterBy = document.getElementById('filter-drivers-by').value
    let filter = document.querySelector('input[name="filter-drivers"]').value

    const req = {
      filterBy,
      filter
    }

    const res = await fetch('/api/filterDrivers', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(req)
    })

    const query = await res.json()
    console.log(query)

    filteredClients.innerHTML = ''
    let htmlCode = ''
    let x = 2
    query.forEach(client => {
      htmlCode += `<option value="${client.id}">${client.name}</option>`
    })

    filteredClients.innerHTML = htmlCode
  })();
})

document.addEventListener('DOMContentLoaded', event => {
  (async () => {
    let filteredClients = document.getElementById('filtered-clients')
    let filterBy = document.getElementById('filter-clients-by').value
    let filter = document.querySelector('input[name="filter-clients"]').value

    const req = {
      filterBy,
      filter
    }

    const res = await fetch('/api/filterClients', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(req)
    })

    const query = await res.json()
    console.log(query)

    filteredClients.innerHTML = ''
    let htmlCode = ''
    let x = 2
    query.forEach(client => {
      htmlCode += `<option value="${client.id}">${client.name}</option>`
    })

    filteredClients.innerHTML = htmlCode
  })();

  (async () => {
    let filteredClients = document.getElementById('filtered-drivers')
    let filterBy = document.getElementById('filter-drivers-by').value
    let filter = document.querySelector('input[name="filter-drivers"]').value

    const req = {
      filterBy,
      filter
    }

    const res = await fetch('/api/filterDrivers', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(req)
    })

    const query = await res.json()
    console.log(query)

    filteredClients.innerHTML = ''
    let htmlCode = ''
    let x = 2
    query.forEach(client => {
      htmlCode += `<option value="${client.id}">${client.name}</option>`
    })

    filteredClients.innerHTML = htmlCode
  })();
  
  
})

window.initMap = initMap;

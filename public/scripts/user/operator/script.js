
document.getElementsByTagName('table')[0].addEventListener('click', event => {
  if (event.target.innerText == 'Borrar') {
    // Mostrar un cuadro de diálogo de confirmación
    if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
      const id = event.target.getAttribute('value-id');

      fetch('/api/deleteClient/' + id, {
        method: 'delete'
      }).then(response => {
        window.location.reload();
      });
    }
  }
});


document.getElementsByTagName('table')[0].addEventListener('click', event => {
  if (event.target.getAttribute('value-rol') == 'operator') {
    if (event.target.innerText == 'Modificar') {
      shadowContainer.classList.toggle('toggle-shadow-container')
      document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
      document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
      document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
      document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
    }
  }
})

document.getElementById('btn-delete-client').addEventListener('click', event => {
  console.log('ga')
  const id = event.target.getAttribute('value-id')

  fetch('/api/deleteClient/' + id, {
    method: 'delete'
  }).then(response => {
    window.location.reload()
  })
})

document.getElementById('btn-modify-client').addEventListener('click', event => {
  shadowContainer.classList.toggle('toggle-shadow-container')
  document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
  document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
  document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
  document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
})

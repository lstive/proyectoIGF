const openShadowContainer = document.getElementsByClassName('open-shadow-container')[0]
const closeShadowContainer = document.getElementsByClassName('close-shadow-container')[0]
const shadowContainer = document.getElementsByClassName('shadow-container')[0]

openShadowContainer.addEventListener('click', () => {
  shadowContainer.classList.toggle('toggle-shadow-container')
  document.querySelector('input[name="id"]').value = ''
  document.querySelector('input[name="name"]').value = ''
  document.querySelector('input[name="email"]').value = ''
  document.querySelector('input[name="phone"]').value = ''
  document.querySelector('input[name="license"]').value = ''
  document.querySelector('input[name="direction"]').value = ''
  document.querySelector('input[name="password"]').value = ''
})

closeShadowContainer.addEventListener('click', event => {
  event.preventDefault()
  shadowContainer.classList.toggle('toggle-shadow-container')
})

// operator value
document.getElementsByTagName('table')[0].addEventListener('click', event => {
  event.preventDefault()

  if (event.target.getAttribute('value-rol') == 'operator') {
    if (event.target.innerText == 'Borrar') {
      const form = new FormData()
      form.append('id', event.target.getAttribute('value-id'))

      fetch('/api/deleteOperator/' + event.target.getAttribute('value-id'), {
        method: 'delete',
        body: form
      }).then(res => {
        return res.text()
      }).then(res => {
        window.location.reload()
        console.log(res)
      })
    }
  }
})

document.getElementsByTagName('table')[0].addEventListener('click', event => {
  event.preventDefault()

  if (event.target.getAttribute('value-rol') == 'operator') {
    if (event.target.innerText == 'Modificar') {
      shadowContainer.classList.toggle('toggle-shadow-container')
      document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
      document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
      document.querySelector('input[name="email"]').value = event.target.getAttribute('value-email')
    }
  }
})

// admin drivers crud
document.getElementById('btn-delete-driver').addEventListener('click', event => {
  const id = event.target.getAttribute('value-id')

  fetch('/api/deleteDriver/' + id, {
    method: 'delete'
  }).then(response => {
    window.location.reload()
  })
})

document.getElementById('btn-modify-driver').addEventListener('click', event => {
  shadowContainer.classList.toggle('toggle-shadow-container')
  document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
  document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
  document.querySelector('input[name="email"]').value = event.target.getAttribute('value-email')
  document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
  document.querySelector('input[name="license"]').value = event.target.getAttribute('value-license')
  document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
})


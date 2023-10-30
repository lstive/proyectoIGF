const openShadowContainer = document.getElementsByClassName('open-shadow-container')[0]
const closeShadowContainer = document.getElementsByClassName('close-shadow-container')[0]
const shadowContainer = document.getElementsByClassName('shadow-container')[0]

openShadowContainer.addEventListener('click', () => {
  shadowContainer.classList.toggle('toggle-shadow-container')

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

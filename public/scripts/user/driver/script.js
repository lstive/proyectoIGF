document.getElementById('navbar-button-toggle').addEventListener('click', event => {
  document.getElementsByClassName('navbar')[0].classList.toggle('navbar-toggle')
})

document.querySelector('div[class="row"]').addEventListener('click', event => {
  if(event.target.innerText == 'Iniciar') {
    (async () => {
      const res = await fetch('/api/driveBegin', {
        method: 'post',
        headers: {
          'Content-Type': 'application/json'
        },
        
        body: JSON.stringify({
          id: event.target.getAttribute('value-id')
        })
      })

      window.location.reload()
    })()
  }
})

document.querySelector('div[class="row"]').addEventListener('click', event => {
  if(event.target.innerText == 'Terminar') {
    (async () => {
      const res = await fetch('/api/driveEnd', {
        method: 'post',
        headers: {
          'Content-Type': 'application/json'
        },
        
        body: JSON.stringify({
          id: event.target.getAttribute('value-id')
        })
      })

      window.location.reload()
    })()
  }
})

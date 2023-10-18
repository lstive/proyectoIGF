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

$('.custom-btn-container').draggable();

$('.custom-btn-container').click(function() {
    $(this).toggleClass('active1');
})


const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active1')
  modals.forEach(modal => {
    closeModal(modal)
  })
  
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal(modal)
  })
})

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active1')
  overlay.classList.add('active1')
}

function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active1')
  overlay.classList.remove('active1')
  $('.custom-btn-container').toggleClass('active1');
}
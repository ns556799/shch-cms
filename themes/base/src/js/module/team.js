import tingle from 'tingle.js'

const teamMembers = Array.from(document.querySelectorAll('.team-member-item'))

var modal = new tingle.modal({
  footer: true,
  stickyFooter: false,
  closeMethods: ['overlay', 'button', 'escape'],
  closeLabel: 'Close',
  cssClass: ['custom-class-1', 'custom-class-2'],
  onOpen: function() {
    console.log('modal open')
  },
  onClose: function() {
    console.log('modal closed')
  }
})

teamMembers.forEach((teamMember) => {
  teamMember.addEventListener('click', () => {
    modal.setContent(teamMember.innerHTML)
    modal.open()
  })
})

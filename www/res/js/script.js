function toogleMainMenu() {
  if (document.body.classList.contains('is-main-menu-active')) {
    document.body.classList.remove('is-main-menu-active');
  } else {
    document.body.classList.add('is-main-menu-active');
  }
}

function updateMainStructureHeight() {
  var virtualHeader = document.getElementById('virtual-height-main-header');
  var mainHeader = document.getElementById('main-header');
  var mainMenu = document.getElementById('main-menu');
  var y = mainHeader.getBoundingClientRect().height;
  mainMenu.style.height = 'calc(100% - ' + y + 'px)';
  mainMenu.style.top = y + 'px';
  virtualHeader.style.height = y + 'px';
}

try {
  updateMainStructureHeight();
} catch (e) {

}

window.onload = updateMainStructureHeight;
window.onresize = updateMainStructureHeight;
class MobileMenuSwitcher {
  constructor() {
    this.switcher = document.querySelector('.menu-switcher');
    this.menuDecor = document.querySelector('.menu-decor');
    this.buttonIcon = document.querySelector('.button__menu-icon');
    this.buttonText = document.querySelector('.button__menu-text');
    this.addEvents();
  }

  addEvents() {
    if (this.switcher !== null) {
      this.switcher.addEventListener('click', () => {
        if (this.menuDecor.classList.contains('menu-decor--opened')) {
          this.menuDecor.classList.remove('menu-decor--opened');
          this.buttonText.textContent = 'Развернуть';
          this.buttonIcon.classList.remove('_up');
        } else {
          this.menuDecor.classList.add('menu-decor--opened');
          this.buttonText.textContent = 'Свернуть';
          this.buttonIcon.classList.add('_up');
        }
      });
    }
  }
}

export default MobileMenuSwitcher;

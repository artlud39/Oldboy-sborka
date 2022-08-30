class mobileMenuSwitcherWiki {
  constructor() {
    this.switcher = document.querySelector('.menu-switcher');
    this.switcherInMobile = document.querySelector('.menu-switcher--in-mobile');
    this.menuDecor = document.querySelector('.menu-decor');
    this.menu = document.querySelector('.menu');
    this.addEvents();
  }

  addEvents() {
    if (this.switcher !== null) {
      this.switcher.addEventListener('click', () => {
        this.menu.classList.toggle('menu--open');
        this.menuDecor.classList.toggle('menu-decor--opened');
      });
      this.switcherInMobile.addEventListener('click', () => {
        if (this.menu.classList.contains('menu--open')) {
          this.menu.classList.remove('menu--open');
          this.menuDecor.classList.remove('menu-decor--opened');
        }
      });
    }
  }
}

export default mobileMenuSwitcherWiki;

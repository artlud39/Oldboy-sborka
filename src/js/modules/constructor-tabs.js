class ConstructorTabs {
  constructor() {
    this.navListElement = document.querySelector(`.constructor__nav-list`);
    this.navToggleElements = this.navListElement.querySelectorAll(`.constructor__nav-toggle-link`);
    this.constructorListElement = document.querySelector(`.constructor__list`);
    this.constructorItemElements = this.constructorListElement.querySelectorAll(`.constructor__item`);
    this.index = 0;

    this.addEvents();
  }

  activeToggles(n) {
    for (let toggle of this.navToggleElements) {
      toggle.classList.remove(`constructor__nav-toggle-link--active`);
    }

    this.navToggleElements[n].classList.add(`constructor__nav-toggle-link--active`);
  }

  activeConstructor(n) {
    for (let ItemElement of this.constructorItemElements) {
      ItemElement.classList.remove(`constructor__item--active`);
    }
    this.constructorItemElements[n].classList.add(`constructor__item--active`);
  }

  addEvents() {
    this.navToggleElements.forEach((navToggleElement, indexToggle) => {
      navToggleElement.addEventListener(`click`, () => {
        this.index = indexToggle;
        this.activeToggles(this.index);
        this.activeConstructor(this.index);
      })
    })
  }
}

export default ConstructorTabs;



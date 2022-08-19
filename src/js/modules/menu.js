class AnimateMenu {
  constructor() {
    this.menuItemsElements = document.querySelectorAll(`.menu__item`);
    this.i;
    this.addEvents();
  }

  onMenuItemHover(link) {
    if (link.nextElementSibling) {
      const ulElement = link.nextElementSibling;

      ulElement.style.maxHeight = ulElement.scrollHeight + `px`;
      link.classList.add(`menu__link--active`);
    }
  }

  onMenuItemMouseleave(link) {
    if (link.nextElementSibling) {
     let ulElement = link.nextElementSibling;

     link.classList.remove(`menu__link--active`);

     if (ulElement.style.maxHeight) {
       ulElement.style.maxHeight = null;
     }
    }
  }

  addEvents() {
    for (this.i = 0; this.i < this.menuItemsElements.length; this.i++) {
      let itemElement = this.menuItemsElements[this.i];
      let linkElement = itemElement.querySelector(`.menu__link`);

      // обработчик на наведение
      itemElement.addEventListener(`mouseover`, () => {
        this.onMenuItemHover(linkElement);
      });
       // обработчик при перемещении за границы элемента
      itemElement.addEventListener(`mouseleave`, () => {
        this.onMenuItemMouseleave(linkElement);
      });
    }
  }
}

export default AnimateMenu

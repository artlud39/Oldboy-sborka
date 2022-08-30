class MenuEducationDropdown {
  constructor() {
    this.menuCurrentItemsElements = document.querySelectorAll('.menu-education__item-toggle');
    this.menuSubItemsElements = document.querySelectorAll('.menu-education__sub-item');
  }

  onItemClick() {
    const menuCurrentItems = Array.from(this.menuCurrentItemsElements);

    menuCurrentItems.forEach(element => {
      element.addEventListener('click', e => {
        e.preventDefault();
        const parentElement = e.currentTarget.closest('.menu-education__item');

        if (parentElement.classList.contains('menu-education__item--active-js')) {
          parentElement.classList.remove('menu-education__item--active-js');
        } else {
          parentElement.classList.add('menu-education__item--active-js');
        }
      });
    });
  }
}

export default MenuEducationDropdown

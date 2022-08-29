class MenuEducationDropdown {
  constructor() {
    this.menuCurrentItemsElements = document.querySelectorAll('.menu__item-inner');
    this.menuSubItemsElements = document.querySelectorAll('.menu__sub-item');
  }

  onItemClick() {
    const menuCurrentItems = Array.from(this.menuCurrentItemsElements);

    menuCurrentItems.forEach(element => {
      element.addEventListener('click', e => {
        e.preventDefault();
        const parentElement = e.currentTarget.closest('.menu-education__item');

        if (parentElement.classList.contains('menu__item--active-js')) {
          parentElement.classList.remove('menu__item--active-js');
        } else {
          parentElement.classList.add('menu__item--active-js');
        }
      });
    });
  }

  onSubItemClick() {
    const menuSubItems = Array.from(this.menuSubItemsElements);

    menuSubItems.forEach(subItem => {
      subItem.addEventListener('click', e => {
        e.preventDefault();
      });
    });
  }
}

export default MenuEducationDropdown

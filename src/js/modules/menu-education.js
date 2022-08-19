export default class MenuEducation {
  constructor() {
    this.menuCurrentItemsElements = document.querySelectorAll('.menu__item-inner');
    this.menuSubItemsElements = document.querySelectorAll('.menu__sub-item');
  }

  onItemClick() {
    const menuCurrentItems = Array.from(this.menuCurrentItemsElements);

    menuCurrentItems.forEach(element => {
      element.addEventListener('click', e => {
        e.preventDefault();
        const parentElement = e.currentTarget.closest('.menu__item');

        if (parentElement.classList.contains('menu__item--active')) {
          parentElement.classList.remove('menu__item--active');
        } else {
          parentElement.classList.add('menu__item--active');
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

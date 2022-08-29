export default class NavigationChain {
  constructor() {
    this.navigationItem = document.querySelectorAll('.navigation-chain__item')
  }

  hasActiveChain() {
    if (this.navigationItem !== null) {
      if (this.navigationItem.length <= 1) {
        this.navigationItem[0].classList.add('navigation-chain__item--prevent-default-js')
        this.navigationItem[0].classList.add('navigation-chain__item--mobile-active-js')
      } else {
        this.navigationItem.forEach(item => {
          item.classList.add('navigation-chain__item--line-js')
          this.navigationItem[this.navigationItem.length - 1].classList.remove('navigation-chain__item--line-js')
          this.navigationItem[this.navigationItem.length - 1].classList.add('navigation-chain__item--prevent-default-js')
          this.navigationItem[this.navigationItem.length - 1].classList.add('navigation-chain__item--mobile-active-js')
          this.navigationItem[this.navigationItem.length - 1].previousElementSibling.classList.add('navigation-chain__item--mobile-active-js')
        })
      }
    }
  }
}

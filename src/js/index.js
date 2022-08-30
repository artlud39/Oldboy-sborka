// import React from 'react'
// import ReactDom from 'react-dom'
import isWebp from './helper-functions/is-webp.js'
import mobileMenuSwitcherWiki from "./modules/mobile-menu-switcher-wiki.js";
import mobileMenuSwitcherEducation from "./modules/mobile-menu-switcher-education.js";
import AnimateMenu from "./modules/menu.js";
import EducationVideo from "./modules/education-video.js";
import MenuEducationDropdown from "./modules/menu-education-dropdown.js";
import NavigationChain from "./modules/navigation-chain.js";
// import App from './components/App.js'

// isWebp();
new AnimateMenu();
new mobileMenuSwitcherWiki();
new mobileMenuSwitcherEducation();
const menuEducationDropdown = new MenuEducationDropdown();
menuEducationDropdown.onItemClick();

const educationVideo = new EducationVideo();
educationVideo.canPlay();
educationVideo.canStop();

const navigationChain = new NavigationChain();
if (navigationChain.navigationItem.length > 0) navigationChain.hasActiveChain();

// window.addEventListener('load', () => {
//   ReactDom.render(<App />, document.getElementById('app-root'))
// })

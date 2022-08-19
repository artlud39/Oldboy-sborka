import React from 'react'
import ReactDom from 'react-dom'
import isWebp from './components/is-webp.js'

import MobileMenuSwitcher from "./modules/mobileMenuSwitcher.js"
// import AnimateMenu from "./modules/menu"
import EducationVideo from "./modules/education-video.js"
import MenuEducation from "./modules/menu-education.js"
import NavigationChain from "./modules/navigation-chain.js"
import App from './components/App.jsx'

isWebp()

// document.addEventListener('DOMContentLoaded', () => {

// })
new MobileMenuSwitcher()
const educationVideo = new EducationVideo()
educationVideo.canPlay()
educationVideo.canStop()
const navigationChain = new NavigationChain()
navigationChain.hasActiveChain()

// new AnimateMenu()

const menuEducation = new MenuEducation()

menuEducation.onItemClick()
menuEducation.onSubItemClick()

ReactDom.render(<App />, document.getElementById('app-root'))
window.addEventListener('load', () => {
})

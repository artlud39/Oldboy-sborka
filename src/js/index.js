import React from 'react'
import ReactDom from 'react-dom'
import isWebp from './components/is-webp.js'
import { Timer } from './components/Timer.jsx'
isWebp()

window.addEventListener('load', () => {
  ReactDom.render(<Timer />, document.getElementById('app-root'))
})

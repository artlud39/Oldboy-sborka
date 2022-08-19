import React from 'react'
import ReactDom from 'react-dom'
import isWebp from './components/is-webp.js'
import Review from './components/Review.jsx'
isWebp()

window.addEventListener('load', () => {
  ReactDom.render(<Review />, document.getElementById('app-root'))
})

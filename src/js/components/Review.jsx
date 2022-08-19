import React from 'react'

export default function Review() {

  return (
    <div className="review">
      <blockquote className="review__quote">
        <p className="review__text">1</p>

        <footer className="review__details">
          <cite className="review__author">2</cite>
          <time className="review__date">3</time>
        </footer>
      </blockquote>

      <div className="review__rating">4</div>
    </div>
  )
}

export default class EducationVideo {
  constructor() {
    this.buttonPlay = document.querySelector('.video__play--btn-play-js');
    this.video = document.querySelector('.video__iframe--video-js');
  }

  canPlay() {
    if (this.buttonPlay !== null) {
      this.buttonPlay.addEventListener('click', () => {
        this.video.play();
        this.switchPlay();
      });
    }
  }

  canStop() {
    if (this.video !== null) {
      this.video.addEventListener('click', () => {
        this.switchPlay();
      });
    }
  }

  switchPlay() {
    if (this.buttonPlay.classList.contains('_disActive')) {
      this.buttonPlay.classList.remove('_disActive');
    } else {
      this.buttonPlay.classList.add('_disActive');
    }
  }
}

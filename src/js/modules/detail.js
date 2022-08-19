document.addEventListener("DOMContentLoaded", () => {
  const previewTriggers = Array.from(document.querySelectorAll('.preview-trigger'));
  const sections = Array.from(document.querySelectorAll("[data-sectionid]"));
  const buttonsTriggers = Array.from(document.querySelectorAll(".constructor__button"));

  sections.map((startTrigger) => {
    const startTriggerID = startTrigger.dataset.sectionid;
    startTrigger.addEventListener('click', (event) => sendIDForSectionGallery(startTriggerID, event));
  })

  previewTriggers.map((trigger) => {
    const id = trigger.dataset.id;
    trigger.addEventListener('click', (event) => sendIdForDetailImage(id, event));
  })

  buttonsTriggers.map((trigger) => trigger.addEventListener('click', () => sendIDsOfImages(trigger)))
});

function sendIDsOfImages(trigger) {
  const images = document.querySelectorAll("[data-imgid]");

  var obj = {
    type: trigger.dataset.type,
    images: new Array()
  };

  images.forEach((imageContainer) => {
    var imgid = imageContainer.dataset.imgid;

    if (imageContainer.classList.contains('vk-desktop__price-img') || imageContainer.classList.contains('insta__topical-img')) {
      //obj.imagesArray = imageContainer.dataset.imgid.split(',')

      if (imgid.indexOf(',') > -1) {
        obj.images = obj.images.concat(imgid.split(','));
      } else {
        obj.images.push(imgid);
      }
    }

    else if (imageContainer.classList.contains('vk-desktop__avatar-img')) {
      //obj.imageAvatar = imageContainer.dataset.imgid;
      obj.images.push(imgid);
    }

    else {
      //obj.imagePaper = imageContainer.dataset.imgid;
      obj.images.push(imgid);
    }
  })

  var imgSet = obj.images.filter((item, pos) => obj.images.indexOf(item) == pos);

  var targetHref = '/local/ajax/download.php';

  targetHref += '?type=' + obj.type + '&back=' + encodeURI(window.location.href);
  targetHref += '&' + imgSet.map((id) => 'files[]=' + id).join('&');
  window.location.href = targetHref;
}

function addImageToContainer(data) {
  const dict = {
    "23": {
      containerClass: '.paperDataContainer',
      imageClass: 'vk-desktop__paper-img',
      itemClass: 'vk-desktop__price-item',
      linkClass: 'vk-desktop__price-link'
    },
    "27": {
      containerClass: '.avatarImageDataContainer',
      imageClass: 'vk-desktop__avatar-img',
      itemClass: 'vk-desktop__price-item',
      linkClass: 'vk-desktop__price-link'
    },
    "28": {
      containerClass: '.priceDataContainer',
      imageClass: 'vk-desktop__price-img',
      itemClass: 'vk-desktop__price-item',
      linkClass: 'vk-desktop__price-link'
    },
    "31": {
      containerClass: '.priceDataContainer',
      imageClass: 'insta__topical-img',
      itemClass: 'insta__topical-item',
      linkClass: 'insta__topical-link'
    },
    "30": {
      containerClass: '.insta__avatar-link',
      imageClass: 'insta__avatar-img',
      linkClass: 'vk-desktop__price-link'
    }
  }

  const sectionID = data.section;
  const containers = Array.from(document.querySelectorAll(`${dict[sectionID].containerClass}`));
  if (sectionID === "28" || sectionID === '31') {
    var photosURL = [];
    if (sectionID === "28") { /* vk */
      photosURL = data.paths.slice(0, 3);
    } else {
      photosURL = data.paths.slice(0, 4);
    }
    containers.map((container) => {
      container.innerHTML = '';
    })

    let clonedItem = undefined;

    photosURL.map((url) => {
      const img = document.createElement('img');
      const link = document.createElement('a');
      const item = document.createElement('li');
      item.classList.add(dict[sectionID].itemClass);
      link.href = '#';
      link.classList.add(dict[sectionID].linkClass);
      link.appendChild(img);
      item.append(link)
      img.src = url;
      const photosIDsInString = data.photosIDs[0] + "";
      img.dataset.imgid = photosIDsInString;
      img.classList.add(dict[sectionID].imageClass)
      containers.map((container) => {
        clonedItem = item.cloneNode(true)
        container.appendChild(clonedItem);
      });
    })
  }

  else {
    containers.map((container) => {
      container.innerHTML = '';

      const img = document.createElement('img');
      const imageURL = data.path;

      img.src = imageURL;
      img.dataset.imgid = data.imageID
      img.classList.add(dict[sectionID].imageClass);
      container.appendChild(img);
    })
  }
}

function addImagesToContainer(images) {
  const containers = document.querySelectorAll('.gallery__list');
  containers.forEach((container) => {
    container.innerHTML = images;
    if (container.classList.contains('gallery__list--mobile')) {
      container.classList.add('gallery__list--mobile-animation');
    }
    else {
      container.classList.add('gallery__list--active');
    }
  })
}

function sendIdForDetailImage(id, evt) {
  if (evt !== undefined) {
    evt.preventDefault();
  }

  const url = '/local/ajax/addDetailImage.php';
  const data = id;
  const xhr = new XMLHttpRequest();

  xhr.open('GET', `/local/ajax/addDetailImage.php?imageID=${data}`, true);
  xhr.onload = function () {
    let response = xhr.responseText;
    const data = JSON.parse(response);
    addImageToContainer(data);
  }

  xhr.send();
}

function sendIDForSectionGallery(id, evt) {
  if (evt !== undefined) {
    evt.preventDefault();
  }

  const url = '/local/ajax/addPreviewImages.php';
  const data = id;
  const xhr = new XMLHttpRequest();

  xhr.open('GET', `/local/ajax/addPreviewImages.php?sectionid=${data}`, true);
  xhr.onload = function () {
    let response = xhr.responseText;
    addImagesToContainer(response);
  }

  xhr.send();
}

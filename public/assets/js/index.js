let images = document.querySelectorAll('.img img')
let inputImg = document.querySelector('#image')

images.forEach(image => {
    image.addEventListener('click', e => {
        inputImg.value = image.src
    })
})
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/scss/app.scss';

// start the Stimulus application
// import './bootstrap';

window.addEventListener('load', () => {
    const lastArticleBox = document.querySelector('.last-article--box');
    const lastArticleImgCont = document.querySelector('.last-article--img-container');
    let imgHeight = lastArticleImgCont.offsetHeight;
    let imgWidth = imgHeight * 6/7;
    lastArticleImgCont.style.width = imgWidth + 'px';
    lastArticleBox.style.paddingLeft = imgWidth + 30 + 'px';
});

const vichImageManager = function () {
    const vichContainer = document.querySelector('.vich-image');

    // Hide the delete button
    const vichDeleteInput = vichContainer.querySelector('input[type="checkbox"][name$="[delete]"]');
    vichDeleteInput.parentElement.style.display = 'none';

    const vichLinks = vichContainer.querySelectorAll('a');
    vichLinks.forEach(link => {
        // Hide the download button
        if (link.innerHTML.match(/(Download)/)) {
            link.style.display = 'none';
        }
        // Disable the download action if click on image
        else if (link.children.length === 1 && link.firstElementChild.tagName === 'IMG') {
            link.style.cursor = 'default';
            link.addEventListener('click', (e) => {
                e.preventDefault();
            });
        }
    })
};

module.exports = vichImageManager;

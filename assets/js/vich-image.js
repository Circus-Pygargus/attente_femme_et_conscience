const vichImageManager = function () {
    const vichContainer = document.querySelector('.vich-image');

    if (vichContainer) {
        const imageFileInput = vichContainer.querySelector('#edit_article_form_imageFile_file');
        // Hide the delete button
        const vichDeleteInput = vichContainer.querySelector('input[type="checkbox"][name$="[delete]"]');
        if (vichDeleteInput) {
            vichDeleteInput.parentElement.style.display = 'none';
        }

        const vichLinks = vichContainer.querySelectorAll('a');
        if (vichLinks.length) {
            vichLinks.forEach(link => {
                // Hide the download button
                if (link.innerHTML.match(/(Download)/)) {
                    link.style.display = 'none';
                }
                // This is the displayed image
                else if (link.children.length === 1 && link.firstElementChild.tagName === 'IMG') {
                    // Disable the download action if click on image
                    link.style.cursor = 'default';
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                    });

                    // Build a button to activate the hidden input type file
                    const vichLabel = vichContainer.parentElement.firstChild;
                    const vichCloneLabel = vichLabel.cloneNode(true);
                    vichCloneLabel.htmlFor = imageFileInput.id;
                    vichCloneLabel.classList.add('cloned', 'btn', 'btn-light');
                    vichCloneLabel.innerHTML = 'Uploader une image';
                    vichLabel.parentNode.insertBefore(vichCloneLabel, vichLabel.nextSibling);

                    imageFileInput.addEventListener('change', (e) => {
                        // Manage the displayed image
                        updateImageDisplay(imageFileInput, link);
                    });

                }
            })
        }
    }

    const updateImageDisplay = (fileInput, previewPlace) => {
        while (previewPlace.firstChild) {
            previewPlace.removeChild(previewPlace.firstChild);
        }

        const curFile = fileInput.files[0];
        if (!curFile) {
            previewPlace.innerHTML = 'Il faut choisir un fichier';
        } else {
            if (!isValidFileType(curFile)) {
                previewPlace.innerHTML = 'Il faut choisir un fichier de type image';
            } else {
                // Display new image
                const image = document.createElement('IMG');
                image.src = window.URL.createObjectURL(curFile);
                previewPlace.appendChild(image);
            }
        }
    };

    const fileTypes = [
        'image/jpg',
        'image/jpeg',
        'image/png'
    ];

    const isValidFileType = (file) => {
        let i = 0;
        const max = fileTypes.length;
        for (i; i < max; i++) {
            if (file.type === fileTypes[i]) {
                return true;
            }
        }

        return false;
    }
};

module.exports = vichImageManager;

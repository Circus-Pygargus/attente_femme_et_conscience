window.addEventListener('load', () => {
    const publishForm = document.querySelector('form[name^="publish"][name$="_form"]');
    const publishSlugInput = publishForm.querySelector('input[id^="publish_"][id$="_form_slug"]');
    const publishInput = publishForm.querySelector('input[id^="publish_"][id$="_form_published"]');

    const publishBtns = document.querySelectorAll('.element-published');

    publishBtns.forEach(publishBtn => {
        publishBtn.addEventListener('click', (e) => {
            publishSlugInput.value = publishBtn.dataset.slug;
            publishInput.checked = publishBtn.dataset.published === "1" ? false : true;
            publishBtn.dataset.published = publishBtn.dataset.published === "1" ? "0" : "1";
            publishForm.submit();
        });
    });
});

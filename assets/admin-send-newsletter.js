window.addEventListener('load', () => {
    const sendNewsletterForm = document.querySelector('form[name="send_newsletter_form"]');
    const sendNewsletterSlugInput = sendNewsletterForm.querySelector('#send_newsletter_form_slug');
    const sendNewsletterInput = sendNewsletterForm.querySelector('#send_newsletter_form_isSent');

    const sendNewsletterBtns = document.querySelectorAll('.send-newsletter');

    sendNewsletterBtns.forEach(sendNewsletterBtn => {
        sendNewsletterBtn.addEventListener('click', () => {
            sendNewsletterSlugInput.value = sendNewsletterBtn.dataset.slug;
            sendNewsletterInput.checked = true;
            sendNewsletterForm.submit();
        });
    });
});

const headerOnScrollWatcher = function () {

    const originalHeader = document.querySelector('.header');
    const headerForScroll = originalHeader.cloneNode(true);
    let lastKnownPosition;

    headerForScroll.id = 'header';
    headerForScroll.classList.add('header_default-place');
    document.querySelector('body').appendChild(headerForScroll);

    const headerPositionBackToTop = () => {
        const headerForScroll = document.querySelector('#header');
        if (headerForScroll.classList.contains('header_on-scroll-up')) {
            headerForScroll.classList.replace('header_on-scroll-up', 'header_default-place');
        } else if (headerForScroll.classList.contains('nav_on-scroll-down')) {
            headerForScroll.classList.replace('header_on-scroll-down', 'header_default-place');
        }
    };

    window.addEventListener('scroll', (e) => {
        const headerForScroll = document.querySelector('#header');
        // Set value
        if (lastKnownPosition === undefined) {
            lastKnownPosition = this.window.scrollY;
        }
        // Scroll up
        else if (lastKnownPosition > this.window.scrollY) {
            lastKnownPosition = this.window.scrollY;
            // User is enough down in the page
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                if (headerForScroll.classList.contains('header_default-place')) {
                    headerForScroll.classList.replace('header_default-place', 'header_on-scroll-up');
                } else if (headerForScroll.classList.contains('header_on-scroll-down')) {
                    headerForScroll.classList.replace('header_on-scroll-down', 'header_on-scroll-up');
                }
            } else if (document.body.scrollTop <= 500 || document.documentElement.scrollTop <= 500) {
                if (headerForScroll.classList.contains('header_on-scroll-up')) {
                    headerForScroll.classList.replace('header_on-scroll-up', 'header_default-place');
                }
            }
        }
        // Scroll down
        else if (lastKnownPosition < this.window.scrollY) {
            lastKnownPosition = this.window.scrollY;
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                if (headerForScroll.classList.contains('header_on-scroll-up')) {
                    headerForScroll.classList.replace('header_on-scroll-up', 'header_on-scroll-down');
                }
                // User is too high in the window
                else {
                    if (headerForScroll.classList.contains('header_on-scroll-up')) {
                        this.setTimeout(headerPositionBackToTop, 500);
                    }
                }
            }
        }
    });
};


module.exports = headerOnScrollWatcher;

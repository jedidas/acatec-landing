export default function ScrollTo(selector: string) {
    const buttonScroll = document.querySelectorAll(selector);
    const body = document.querySelector('body');

    buttonScroll.forEach((item) => {
        item.addEventListener('click', (event) => {
            event.preventDefault();
            const btn = item as HTMLAnchorElement;
            const href = btn.getAttribute('data-href');

            href && goTo(href);
        });
    });

    const goTo = (id: string) => {
        var scrollDiv = document.getElementById(id);

        if (scrollDiv) {
            const top = scrollDiv.offsetTop + 70;
            window.scrollTo({ top, behavior: 'smooth' });
            body && body.classList.remove('opened-menu');
        }
    };
}

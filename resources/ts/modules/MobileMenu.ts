export default function MobileMenu() {
    const buttonMenus = document.querySelectorAll<HTMLButtonElement>('.wd-mobile-menu');
    const mainMenu = document.querySelector('body');

    if (buttonMenus && mainMenu) {
        buttonMenus.forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                mainMenu.classList.toggle('open-menu');
            });
        });
    }
}

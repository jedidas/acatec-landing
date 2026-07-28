import store from '@resources/ts/cart-favorites/state/store.ts';
import Events from '@helps/Events';

export default function ShopBag() {
    const shopBagCounter = document.querySelector<HTMLSpanElement>('#shopBagCounter');

    const update = () => {
        if (shopBagCounter) {
            const length = store.getState().cart.items.length;
            shopBagCounter.innerHTML = `${length}`;
        }
    };

    Events.addEventListener<number>('shopBagUpdated', () => {
        update();
    });

    update();
}

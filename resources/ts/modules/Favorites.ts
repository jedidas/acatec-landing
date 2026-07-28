import { FavoriteItemType } from '../cart-favorites/models/ProductType';
import { addItem, removeItem } from '@resources/ts/cart-favorites/state/slices/FavoriteSlice';
import store from '@resources/ts/cart-favorites/state/store.ts';

export default function Favorites() {
    const widget_cart = document.querySelector('.widget_cart');
    const favoriteButton = document.querySelector<HTMLButtonElement>('.widget_cart-favorite-button');

    if (widget_cart && favoriteButton) {
        const productHtml = widget_cart.getAttribute('data-product');

        if (productHtml) {
            const product: FavoriteItemType = JSON.parse(productHtml);

            const addSelectedClass = () => {
                const exist = store.getState().favorite.items.some((item) => item.id === product.id);

                if (exist) {
                    favoriteButton.classList.add('selected');
                } else {
                    favoriteButton.classList.remove('selected');
                }
            };

            favoriteButton.addEventListener('click', (event) => {
                event.preventDefault();

                const exist = store.getState().favorite.items.some((item) => item.id === product.id);

                if (exist) {
                    store.dispatch(removeItem(product.id));
                    favoriteButton.classList.remove('selected');
                } else {
                    store.dispatch(addItem(product));
                    favoriteButton.classList.add('selected');
                }
            });

            addSelectedClass();
        }
    }
}

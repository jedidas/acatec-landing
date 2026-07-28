import Swal from 'sweetalert2';
import { route } from 'ziggy-js';

import { ProductItemType } from '../cart-favorites/models/ProductType';
import Events from '@helps/Events';
import { addOrUpdateItem } from '@resources/ts/cart-favorites/state/slices/CartSlice.ts';
import store from '@resources/ts/cart-favorites/state/store.ts';

export default function Cart() {
    const widget_cart = document.querySelector('.widget_cart');
    const addButton = document.querySelector<HTMLButtonElement>('.widget_cart-add-button');
    const lessButton = document.querySelector<HTMLButtonElement>('.widget_cart-button.less');
    const plusButton = document.querySelector<HTMLButtonElement>('.widget_cart-button.plus');
    const input = document.querySelector<HTMLInputElement>('.widget_cart-input');

    if (widget_cart && addButton && lessButton && plusButton && input) {
        const productHtml = widget_cart.getAttribute('data-product');

        const getQuantity = () => {
            const value = Number(input.value);
            const quantity = isNaN(value) ? 1 : value;
            return quantity;
        };

        const updateInput = (value: number) => {
            input.value = `${value}`;
        };

        input.addEventListener('change', (event) => {
            event.preventDefault();

            let quantity = getQuantity();

            if (quantity >= 99) {
                quantity = 99;
            }
            if (quantity <= 1) {
                quantity = 1;
            }
            updateInput(quantity);
        });

        lessButton.addEventListener('click', (event) => {
            event.preventDefault();

            let quantity = getQuantity();
            if (quantity <= 1) {
                quantity = 1;
            } else {
                quantity--;
            }
            updateInput(quantity);
        });

        plusButton.addEventListener('click', (event) => {
            event.preventDefault();

            let quantity = getQuantity();
            if (quantity >= 99) {
                quantity = 99;
            } else {
                quantity++;
            }
            updateInput(quantity);
        });

        if (productHtml) {
            const product: ProductItemType = JSON.parse(productHtml);

            addButton.addEventListener('click', (event) => {
                event.preventDefault();

                product.quantity = getQuantity();
                store.dispatch(addOrUpdateItem(product));

                Events.emitEvent('shopBagUpdated');

                Swal.fire({
                    title: 'Producto agregado',
                    html: `
          <div class="flex flex-col justify-center gap-3">
            <div class="flex flex-col w-full">
                <picture class="flex justify-center overflow-hidden mb-2">
                    <img src="${product.img}" alt="${product.name}" class="block rounded-md w-40"
                        style="aspect-ratio: 4 / 3;">
                </picture>
                <h3 class="text-lg font-bold">${product.name}</h3>
            </div>
            <div class="flex justify-center item-center ">
                <a href="${route('cart.index')}"
                    class="text-white bg-green-700 hover:bg-green focus:ring-4 focus:ring-green font-medium rounded-sm text-base px-4 py-2.5">
                    Ir al carrito
                </a>
            </div>
          </div>
          `,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#1f1f21',
                });
            });
        }
    }
}

import { ChangeEvent, useState } from 'react';
import Swal from 'sweetalert2';

import { useAppDispatch } from '@resources/ts/cart-favorites/state/hooks.ts';
import { removeItem, updateQuantityOfItem } from '@resources/ts/cart-favorites/state/slices/CartSlice.ts';
import { removeItem as favoriteRemoveItem } from '@resources/ts/cart-favorites/state/slices/FavoriteSlice';

import useEvent from '@helps/useEvent';

type useCartProps = { id: number; quantityValue: number; type: TypeApp };

export type TypeApp = 'cart' | 'favorites';

export default function useCart({ id, quantityValue, type }: useCartProps) {
    const [quantity, setQuantity] = useState(quantityValue);

    const dispatch = useAppDispatch();

    const changeMethod = useEvent((event: ChangeEvent<HTMLInputElement>) => {
        let value = isNaN(Number(event.target.value)) ? 1 : Number(event.target.value);

        if (value <= 1) {
            value = 1;
        }
        if (value >= 99) {
            value = 99;
        }

        setQuantity(value);
        dispatch(updateQuantityOfItem({ id, quantity: value }));
    });

    const increaseDecreaseMethod = useEvent((action: 'increase' | 'decrease') => {
        let value = quantity;
        if (action === 'increase') {
            if (quantity >= 99) {
                value = 99;
            } else {
                value++;
            }
        } else {
            if (quantity <= 1) {
                value = 1;
            } else {
                value--;
            }
        }
        setQuantity(value);
        dispatch(updateQuantityOfItem({ id, quantity: value }));
    });

    const deleteMethod = (name = '') => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: `Eliminar ${name}`,
            icon: 'warning',
            iconColor: '#1f1f21',
            showCancelButton: true,
            confirmButtonColor: '#37b202',
            cancelButtonColor: '#b20202',
            confirmButtonText: 'Borrar',
        }).then((result) => {
            if (result.isConfirmed) {
                if (type === 'cart') {
                    dispatch(removeItem(id));
                }
                if (type === 'favorites') {
                    dispatch(favoriteRemoveItem(id));
                }
            }
        });
    };

    return { changeMethod, increaseDecreaseMethod, deleteMethod, quantity };
}

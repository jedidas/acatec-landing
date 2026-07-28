import styles from './App.module.scss';

import useCheckProducts from '../hooks/useCheckProducts';
import { FavoriteItemType, ProductItemType } from '../models/ProductType';
import { useAppSelector } from '../state/hooks';
import { getItems as getCartItems } from '../state/slices/CartSlice';
import { getItems as getFavoriteItems } from '../state/slices/FavoriteSlice';
import ProductItem from './ProductItem';
import QuotationForm from './QuotationForm';
import { TypeApp } from '../hooks/useCart';

type AppProps = {
    type: TypeApp;
};

export default function App({ type }: AppProps) {
    const cartItems: FavoriteItemType[] | ProductItemType[] = useAppSelector(
        type === 'cart' ? getCartItems : getFavoriteItems,
    );

    useCheckProducts({ type });

    if (!cartItems.length) {
        return (
            <>
                <div className={styles.cartApp}>
                    <div className="bg-softGray border-lightGray flex items-center justify-center border p-10">
                        <p className="text-blackPearl mb-1 text-lg font-bold">Sin datos</p>
                    </div>
                </div>
            </>
        );
    }

    return (
        <>
            <div className={styles.cartApp}>
                <div className="mb-5 flex flex-col gap-3 bg-neutral-100 p-3">
                    {cartItems.map((item, index) => (
                        <ProductItem key={index} product={item} type={type} />
                    ))}
                </div>
            </div>
            {type === 'cart' && <QuotationForm />}
        </>
    );
}

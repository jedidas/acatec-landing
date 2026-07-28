import { Button, ButtonGroup, TextInput } from 'flowbite-react';

import DeleteIcon from '@resources/ts/cart-favorites/components/DeleteIcon';
import { TypeApp } from '@resources/ts/cart-favorites-app';
import useCart from '@resources/ts/cart-favorites/hooks/useCart.ts';
import { ProductItemType } from '@resources/ts/cart-favorites/models/ProductType.ts';

type ProductItemProps = { product: ProductItemType; type: TypeApp };

import styles from './ProductItem.module.scss';

export default function ProductItem({ product, type }: ProductItemProps) {
    const { changeMethod, increaseDecreaseMethod, deleteMethod, quantity } = useCart({
        id: product.id,
        quantityValue: product.quantity,
        type,
    });

    const getControllers = () => (
        <div className="">
            <ButtonGroup className="rounded-base inline-flex -space-x-px shadow-xs">
                <Button
                    onClick={() => increaseDecreaseMethod('decrease')}
                    className="text-body bg-neutral-primary-soft border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-neutral-tertiary-soft rounded-s-base h-9 border px-2 py-2 text-sm leading-5 font-medium focus:ring-3 focus:outline-none lg:h-14 lg:px-3"
                    disabled={!product.is_valid}
                >
                    -
                </Button>
                <TextInput
                    type="number"
                    sizing="md"
                    value={quantity}
                    className={`${styles.inputQuantity} text-body bg-neutral-primary-soft border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-neutral-tertiary-soft h-9 border border-none px-1 py-1 text-sm leading-5 font-medium focus:ring-3 focus:outline-none lg:h-14 lg:px-3`}
                    min={1}
                    max={99}
                    onChange={changeMethod}
                    radioGroup="0"
                    disabled={!product.is_valid}
                />
                <Button
                    onClick={() => increaseDecreaseMethod('increase')}
                    className="text-body bg-neutral-primary-soft border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-neutral-tertiary-soft rounded-e-base h-9 border px-2 text-sm leading-5 font-medium focus:ring-3 focus:outline-none lg:h-14 lg:px-3"
                    disabled={!product.is_valid}
                >
                    +
                </Button>
            </ButtonGroup>
        </div>
    );

    return (
        <div
            className={`${styles.productItem} ${!product.is_valid && styles.isValid} bg-softGray flex flex-col border border-none bg-white sm:flex-row sm:gap-1 sm:pr-4 lg:gap-4`}
        >
            <div className="w-full overflow-hidden sm:max-w-44">
                {product.is_valid ? (
                    <a href={product.url} className="flex items-center justify-center p-3 lg:block">
                        <img src={product.img} alt={product.name} className="block w-40" />
                    </a>
                ) : (
                    <div className="flex items-center justify-center p-3 lg:block">
                        <img src={product.img} alt={product.name} className="block w-40" />
                    </div>
                )}
            </div>
            <div className="flex w-full flex-col gap-2 p-3 pt-0 sm:px-0 sm:py-2">
                <h4 className="text-successGreen hover:text-successGreenHover text-center text-xl font-bold sm:text-left">
                    {product.is_valid ? <a href={product.url}>{product.name} </a> : product.name}
                </h4>
                <div className="flex items-center justify-center gap-1 sm:justify-start lg:gap-2">
                    {type === 'cart' ? getControllers() : null}
                    <div>
                        <Button
                            type="button"
                            color="none"
                            className="focus:ring-brand-medium text-danger hover:text-danger-strong box-border flex cursor-pointer gap-2 border border-transparent px-1 py-2.5 text-sm leading-5 font-medium focus:shadow-none focus:ring-0 focus:outline-none lg:px-4"
                            onClick={() => deleteMethod(product.name)}
                        >
                            <DeleteIcon className="fill-danger" />
                            Borrar
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    );
}

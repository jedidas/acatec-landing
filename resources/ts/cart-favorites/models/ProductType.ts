export type ProductType = {
    id: number;
    category_id: number;
    name: string;
    slug: string;
    image: string;
    price: number;
    discount: number;
    code: string;
    final_price: number;
    url: string;
};

export type ProductItemType = ProductType & {
    img: string;
    is_selected: boolean;
    is_valid: boolean;
    quantity: number;
};

export type FavoriteItemType = ProductItemType & Omit<ProductItemType, 'quantity'>;

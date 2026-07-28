import { FavoriteItemType, ProductItemType } from "@resources/ts/cart-favorites/models/ProductType";

type processProductListProps = {
  cartItems: ProductItemType[];
  productsFromAPI: ProductItemType[];
  baseUrl: string;
};

export function processProductList({
  cartItems,
  productsFromAPI,
  baseUrl,
}: processProductListProps): ProductItemType[] {
  return cartItems.map(item => {
    const updatedItem = {
      ...item,
      is_valid: false,
      image: `${baseUrl}/images/products/not-found.jpg`,
    };

    const matchedProduct = productsFromAPI.find(prod => prod.id === item.id);
    if (matchedProduct) {
      return {
        ...updatedItem,
        name: matchedProduct.name,
        price: matchedProduct.price,
        final_price: matchedProduct.final_price,
        discount: matchedProduct.discount,
        image: matchedProduct.image,
        url: matchedProduct.url,
        is_valid: true,
      };
    }

    return updatedItem;
  });
}

export function processFavoriteList({
  cartItems,
  productsFromAPI,
  baseUrl,
}: processProductListProps): FavoriteItemType[] {
  return cartItems.map(item => {
    const updatedItem = {
      ...item,
      is_valid: false,
      image: `${baseUrl}/images/products/not-found.jpg`,
    };

    const matchedProduct = productsFromAPI.find(prod => prod.id === item.id);
    if (matchedProduct) {
      return {
        ...updatedItem,
        name: matchedProduct.name,
        price: matchedProduct.price,
        final_price: matchedProduct.final_price,
        discount: matchedProduct.discount,
        image: matchedProduct.image,
        url: matchedProduct.url,
        is_valid: true,
      };
    }

    return updatedItem;
  });
}

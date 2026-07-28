import { useEffect } from "react";

import { processFavoriteList, processProductList } from "../commons/ProductUtils";
import { FavoriteItemType, ProductItemType } from "../models/ProductType";
import { useAppDispatch, useAppSelector } from "../state/hooks";
import { getItems as getCartItems, updateCheckedItems } from "../state/slices/CartSlice";
import {
  getItems as getFavoriteItems,
  updateCheckedItems as updateCheckedFavoriteItems,
} from "../state/slices/FavoriteSlice";
import { TypeApp } from "@resources/ts/cart-favorites-app";
import CartAndFavoritesService from "@resources/ts/services/CartAndFavoritesService";

type useCheckCartProps = {
  type: TypeApp;
};
export default function useCheckProducts({ type }: useCheckCartProps) {
  const cartItems = useAppSelector(type === "cart" ? getCartItems : getFavoriteItems);

  const dispatch = useAppDispatch();

  const baseUrl = import.meta.env.VITE_APP_URL;

  useEffect(() => {
    const fetchProducts = () => {
      CartAndFavoritesService.check(cartItems.map(item => item.id))
        .then(response => {
          if (response.status === 200) {
            if (type === "cart") {
              const updatedItems = processProductList({
                cartItems,
                productsFromAPI: response.data.data as ProductItemType[],
                baseUrl,
              });

              dispatch(updateCheckedItems(updatedItems));
            }

            if (type === "favorites") {
              const updatedItems = processFavoriteList({
                cartItems,
                productsFromAPI: response.data.data as FavoriteItemType[],
                baseUrl,
              });

              dispatch(updateCheckedFavoriteItems(updatedItems));
            }
          }
        })
        .catch(error => {
          console.error(error);
        });
    };

    fetchProducts();
  }, []);
}

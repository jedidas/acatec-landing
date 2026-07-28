import { createSlice, PayloadAction } from "@reduxjs/toolkit";

import { FavoritesAndCart } from "@resources/ts/cart-favorites/commons/slices/FavoritesAndCart";
import { FavoriteItemType } from "@resources/ts/cart-favorites/models/ProductType.ts";
import { RootState } from "@resources/ts/cart-favorites/state/store.ts";

export interface FavoriteState {
  items: FavoriteItemType[];
}

const initialState: FavoriteState = {
  items: [],
};

export const FavoriteSlice = createSlice({
  name: "favoriteSlice",
  initialState,
  reducers: {
    ...FavoritesAndCart<FavoriteItemType>(),
    toggle: (state, action: PayloadAction<FavoriteItemType>) => {
      const item = action.payload;
      const existingItemIndex = state.items.findIndex(i => i.id === item.id);

      if (existingItemIndex !== -1) {
        state.items.splice(existingItemIndex, 1);
      } else {
        state.items.push(item);
      }
    },
  },
});

export const { addItem, removeItem, cleanAll, disableEnableItem, toggle, updateCheckedItems } = FavoriteSlice.actions;

export const getItems = (state: RootState) => state.favorite.items;
export const getById = (state: RootState, id: number) => state.favorite.items.find(item => item.id === id);

export default FavoriteSlice.reducer;

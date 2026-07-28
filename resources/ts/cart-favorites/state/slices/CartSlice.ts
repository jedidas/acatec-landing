import { createSlice, PayloadAction } from "@reduxjs/toolkit";

import { FavoritesAndCart } from "@resources/ts/cart-favorites/commons/slices/FavoritesAndCart";
import { ProductItemType } from "@resources/ts/cart-favorites/models/ProductType.ts";
import { RootState } from "@resources/ts/cart-favorites/state/store.ts";

export interface CartState {
  items: ProductItemType[];
}

const initialState: CartState = {
  items: [],
};

export const CartSlice = createSlice({
  name: "cartSlice",
  initialState,
  reducers: {
    ...FavoritesAndCart<ProductItemType>(),
    updateQuantityOfItem: (state, action: PayloadAction<{ id: number; quantity: number }>) => {
      const { id, quantity } = action.payload;
      const itemToUpdate = state.items.find(item => item.id === id);
      if (itemToUpdate) {
        itemToUpdate.quantity = quantity;
      }
    },
    updateSelectedItem: (state, action: PayloadAction<{ id: number; is_selected: boolean }>) => {
      const { id, is_selected } = action.payload;
      const itemToUpdate = state.items.find(item => item.id === id);
      if (itemToUpdate) {
        itemToUpdate.is_selected = is_selected;
      }
    },
    addOrUpdateItem: (state, action: PayloadAction<ProductItemType>) => {
      const newItem = action.payload;
      const existingItem = state.items.find(item => item.id === newItem.id);
      if (existingItem) {
        existingItem.quantity += newItem.quantity;
        existingItem.is_valid = newItem.is_valid;
      } else {
        state.items.push({ ...newItem });
      }
    },
  },
});

export const {
  addItem,
  removeItem,
  cleanAll,
  updateCheckedItems,
  updateQuantityOfItem,
  disableEnableItem,
  addOrUpdateItem,
  updateSelectedItem,
} = CartSlice.actions;

export const getItems = (state: RootState) => state.cart.items;

export default CartSlice.reducer;

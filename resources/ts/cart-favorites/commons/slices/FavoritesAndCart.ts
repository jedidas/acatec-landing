import { PayloadAction } from "@reduxjs/toolkit";

export function FavoritesAndCart<T extends { id: number; is_valid?: boolean }>() {
  return {
    addItem: (state: { items: T[] }, action: PayloadAction<T>) => {
      state.items.push(action.payload);
    },
    removeItem: (state: { items: T[] }, action: PayloadAction<number>) => {
      state.items = state.items.filter(item => item.id !== action.payload);
    },
    cleanAll: (state: { items: T[] }) => {
      state.items = [];
    },
    updateCheckedItems: (state: { items: T[] }, action: PayloadAction<T[]>) => {
      state.items = action.payload;
    },
    disableEnableItem: (state: { items: T[] }, action: PayloadAction<{ id: number; is_valid: boolean }>) => {
      const { id, is_valid } = action.payload;
      const itemToUpdate = state.items.find(item => item.id === id);
      if (itemToUpdate) {
        itemToUpdate.is_valid = is_valid;
      }
    },
  };
}

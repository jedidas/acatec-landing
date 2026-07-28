import { Spinner } from 'flowbite-react';
import React from 'react';
import ReactDOM from 'react-dom/client';
import { Provider } from 'react-redux';
import { PersistGate } from 'redux-persist/integration/react';

import App from './cart-favorites/components/App';
import store, { persistor } from './cart-favorites/state/store';

const favoritesApp = document.getElementById('favorites-app');
const cartApp = document.getElementById('cart-app');
export type TypeApp = 'cart' | 'favorites';

const rootElement = favoritesApp || cartApp;
const type = (favoritesApp ? 'favorites' : null) || (cartApp ? 'cart' : null);

if (rootElement && type) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <Provider store={store}>
                <PersistGate
                    loading={<Spinner aria-label="Extra large spinner example" size="xl" />}
                    persistor={persistor}
                >
                    <App type={type} />
                </PersistGate>
            </Provider>
        </React.StrictMode>,
    );
}

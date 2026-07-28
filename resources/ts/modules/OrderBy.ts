import { route } from 'ziggy-js';

type RouteParameters = {
    categorySlug: string;
    page?: string;
    order_by?: string;
};

export default function OrderBy() {
    const form = document.querySelector<HTMLFormElement>('#order_widget');

    if (!form) {
        return;
    }

    const select = form.querySelector<HTMLSelectElement>('select');

    if (!select) {
        return;
    }

    const navigate = (value: string) => {
        const { categorySlug } = route().params;

        const url = new URL(window.location.href);

        const parameters: RouteParameters = {
            categorySlug,
        };

        const page = url.searchParams.get('page');
        const currentOrderBy = url.searchParams.get('order_by');

        if (page) {
            parameters.page = page;
        }

        if (currentOrderBy) {
            parameters.order_by = currentOrderBy;
        }

        if (value.trim()) {
            parameters.order_by = value.trim();
        } else {
            delete parameters.order_by;
        }

        const finalRoute = route('category.index', parameters);

        if (window.location.href !== finalRoute) {
            window.location.assign(finalRoute);
        }
    };

    select.addEventListener('change', ({ target }) => {
        navigate((target as HTMLSelectElement).value);
    });

    navigate(select.value);
}

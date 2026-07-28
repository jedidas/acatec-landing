import axiosInstance from './axiosInstance';

export type ResponseType = {
    status: number;
    message: string;
    data: VerifiedItems[];
};

function CartAndFavoritesServiceApi() {
    function check(data: number[]) {
        return axiosInstance.post<ResponseType>('/api/verify-items', data);
    }

    return {
        check,
    };
}

const CartAndFavoritesService = CartAndFavoritesServiceApi();
export default CartAndFavoritesService;

export type VerifiedItems = {
    id: number;
    name: string;
    price: number;
    final_price: number;
    discount: number;
    image: string;
    url: string;
};

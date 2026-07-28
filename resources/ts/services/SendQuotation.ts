import { ProductItemType } from '@resources/ts/cart-favorites/models/ProductType.ts';
import axiosInstance from './axiosInstance';

export type ResponseQuotationType = {
    status: number;
    message: string;
    data: any;
};

export type QuotationFormValues = {
    name: string;
    email: string;
    phone: string;
    message: string;
    products: ProductItemType[];
};

export type sendQuotationProps = QuotationFormValues & {
    token: string;
};

function QuotationServiceApi() {
    function send(data: sendQuotationProps) {
        return axiosInstance.post<ResponseQuotationType>('/api/quote/send', data);
    }

    return { send };
}

const QuotationService = QuotationServiceApi();
export default QuotationService;

import axios, { AxiosError } from 'axios';

export const BASE_URL = import.meta.env.VITE_APP_URL;

export type DefaultResponseType = {
    state: boolean;
    message: string;
    data: any;
};

export const axiosInstance = (csrfToken: string) => {
    return axios.create({
        baseURL: BASE_URL,
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
        },
        responseType: 'json',
    });
};

const csrfToken = document.querySelector('[name="csrf-token"]') as HTMLInputElement;

export default axiosInstance(csrfToken.value);

export const axiosInstanceFormData = (csrfToken: string) => {
    return axios.create({
        baseURL: BASE_URL,
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
        },
        responseType: 'json',
    });
};

export const instanceFormData = axiosInstanceFormData(csrfToken.value);

export type CustomAxiosError<T = Record<string, string[]>> = AxiosError & {
    code?: string;
    message: string;
    config: {
        baseURL: string;
        headers: Record<string, string>;
        method: string;
        url: string;
        timeout: number;
        transformRequest: Function[];
        transformResponse: Function[];
        [key: string]: any;
    };
    response: {
        status: number;
        statusText: string;
        data: {
            errors: T;
            message: string;
        };
        headers: Record<string, string>;
        request: XMLHttpRequest;
    };
};

import { DefaultResponseType, instanceFormData } from './axiosInstance';

export type ContactFormTypes = {
    name: string;
    email: string;
    phone: string;
    subject: string;
    message: string;
};

export default function ContactFormService() {
    return {
        contact: (data: FormData) => instanceFormData.post<DefaultResponseType>('/api/contact/send', data),
    };
}

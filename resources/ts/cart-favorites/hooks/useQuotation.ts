import { yupResolver } from '@hookform/resolvers/yup';
import { useCallback, useState } from 'react';
import { SubmitHandler, useForm, useWatch } from 'react-hook-form';
import { load } from 'recaptcha-v3';
import Swal from 'sweetalert2';
import * as yup from 'yup';

import { useAppSelector } from '../state/hooks';
import { getItems } from '../state/slices/CartSlice';
import QuotationService, { QuotationFormValues } from '@resources/ts/services/SendQuotation';

const defaultValues: QuotationFormValues = {
    name: '',
    email: '',
    phone: '',
    message: '',
    products: [],
};

const schema = yup
    .object()
    .shape({
        name: yup
            .string()
            .required('El nombre es requerido.')
            .min(3, 'El nombre debe tener al menos 3 caracteres')
            .max(75, 'El nombre no puede tener más de 75 caracteres'),
        email: yup
            .string()
            .required('El correo es requerido.')
            .email('El correo no es valido.')
            .max(75, 'El correo no puede tener más de 75 caracteres'),
        phone: yup
            .string()
            .min(8, 'El teléfono debe tener al menos 8 caracteres')
            .max(9, 'El teléfono no puede tener más de 9 caracteres')
            .required('El teléfono es requerido'),
        message: yup
            .string()
            .required('El mensaje es requerido')
            .max(1000, 'El mensaje no puede tener más de 1000 caracteres'),
        products: yup.array().required('No tienes ningún producto seleccionado.'),
    })
    .required();

type useQuotationProps = {
    callBackSuccess?: () => void;
};

export default function useQuotation({ callBackSuccess }: useQuotationProps) {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState<string | null>(null);

    const products = useAppSelector(getItems);

    const methods = useForm({
        mode: 'all',
        defaultValues,
        resolver: yupResolver(schema),
    });

    const values = useWatch({ control: methods.control });

    const handleFormSubmit: SubmitHandler<QuotationFormValues> = useCallback(
        async (values: QuotationFormValues, event) => {
            event?.preventDefault();

            const showMessage = (status: 'success' | 'error', message: string) => {
                Swal.fire({
                    title: status === 'success' ? 'Correo enviado' : 'Ocurrio un error',
                    text: message,
                    confirmButtonColor: '#37b202',
                    icon: 'success',
                });
            };

            const API_PUBLIC_KEY = import.meta.env.VITE_API_PUBLIC_KEY;
            setLoading(true);

            load(API_PUBLIC_KEY).then((recaptcha) => {
                recaptcha.execute('validate_captcha').then((token) => {
                    QuotationService.send({
                        name: values.name,
                        email: values.email,
                        phone: values.phone,
                        message: values.message,
                        products,
                        token,
                    })
                        .then((response) => {
                            callBackSuccess && callBackSuccess();
                            showMessage(response.status === 200 ? 'success' : 'error', response.data.message);
                            methods.reset();
                        })
                        .catch((error) => {
                            setError(error?.response?.data?.message);
                        })
                        .finally(() => {
                            setLoading(false);
                        });
                });
            });
        },
        [],
    );

    const callFormSubmission = () => {
        methods.handleSubmit(handleFormSubmit)();
    };

    return { callFormSubmission, error, values, loading, methods };
}

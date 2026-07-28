import { Alert, Modal, ModalBody, ModalHeader, Spinner } from 'flowbite-react';
import { useState } from 'react';
import { FormProvider } from 'react-hook-form';

import styles from './QuotationForm.module.scss';

import useQuotation from '@resources/ts/cart-favorites/hooks/useQuotation.ts';
import { useAppDispatch } from '@resources/ts/cart-favorites/state/hooks.ts';
import { cleanAll } from '@resources/ts/cart-favorites/state/slices/CartSlice';
import SendIcon from '@resources/ts/cart-favorites/components/SendIcon';
import { TextareaField, TextInputField } from '@resources/ts/cart-favorites/components/TextInputField';

export default function QuotationForm() {
    const [showModal, setShowModal] = useState(false);

    const dispatch = useAppDispatch();

    const { callFormSubmission, error, loading, methods } = useQuotation({
        callBackSuccess: () => {
            dispatch(cleanAll());
            setShowModal(false);
        },
    });

    // const hasErrors = Object.keys(methods.formState.errors).length > 0;

    return (
        <>
            <div className={styles.sendFormBox}>
                <button
                    type="button"
                    onClick={() => setShowModal(true)}
                    className="bg-success hover:bg-success-strong focus:ring-success-medium box-border rounded-sm border border-transparent px-4 py-2.5 text-sm leading-5 font-medium text-white shadow-xs focus:ring-4 focus:outline-none"
                >
                    Cotizar
                </button>
            </div>

            <Modal
                show={showModal}
                position="top-center"
                onClose={() => setShowModal(false)}
                className={styles.modal}
                dismissible
            >
                <ModalHeader className={styles.header}>Formulario de cotización</ModalHeader>
                <ModalBody className={styles.body}>
                    {loading ? (
                        <div className="flex flex-col items-center justify-center gap-2 p-5">
                            <Spinner size="xl" className={styles.spinner} /> <p className="text-sm">Enviando...</p>
                        </div>
                    ) : (
                        <FormProvider {...methods}>
                            <form onSubmit={(event) => event.preventDefault()} className={styles.form}>
                                <TextInputField
                                    name="name"
                                    type="text"
                                    placeholder="¿Cuál es su nombre?"
                                    label="Nombre"
                                    className="mb-1-5"
                                />
                                <TextInputField
                                    name="email"
                                    type="email"
                                    placeholder="¿Cual es su correo electrónico?"
                                    label="Correo electrónico"
                                />
                                <TextInputField
                                    name="phone"
                                    type="phone"
                                    placeholder="¿Cual es su número de teléfono?"
                                    label="Número de teléfono"
                                />
                                <TextareaField
                                    name="message"
                                    label="Mensaje"
                                    placeholder="¿Cual es su mensaje?"
                                    rows={4}
                                />
                                <div>
                                    <button
                                        type="button"
                                        className="bg-success hover:bg-success-strong focus:ring-success-medium box-border flex w-full items-center justify-center gap-2 rounded-sm border border-transparent px-4 py-2.5 text-lg leading-5 font-medium text-white shadow-xs focus:ring-4 focus:outline-none"
                                        onClick={callFormSubmission}
                                    >
                                        <SendIcon className="fill-white" />
                                        Enviar
                                    </button>
                                </div>
                                {error && (
                                    <Alert color="failure">
                                        <span className="font-medium">Error:</span> {error}
                                    </Alert>
                                )}
                            </form>
                        </FormProvider>
                    )}
                </ModalBody>
            </Modal>
        </>
    );
}

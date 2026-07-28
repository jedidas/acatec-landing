import JustValidate, { Rules } from 'just-validate';
import ContactFormService from '@resources/ts/services/ContactService.ts';
import { load } from 'recaptcha-v3';

export default function ContactForm() {
    const formBox = document.querySelector<HTMLDivElement>('.contact-form-box');

    if (formBox) {
        const validator = new JustValidate('#contact-form');

        const API_PUBLIC_KEY = import.meta.env.VITE_API_PUBLIC_KEY;
        const formService = ContactFormService();

        function getMessageElements() {
            const box = formBox?.querySelector<HTMLDivElement>('.messageBox');
            const msg = box?.querySelector<HTMLParagraphElement>('.message') ?? null;
            const err = box?.querySelector<HTMLParagraphElement>('.error') ?? null;
            return { box, msg, err };
        }

        function clearFormStates() {
            formBox?.classList.remove('sent', 'sending', 'error');
        }

        function setMessageVisibility(kind: 'none' | 'success' | 'error') {
            const { box } = getMessageElements();
            if (!box) return;
            box.classList.remove('visible-success', 'visible-error');
            if (kind === 'success') box.classList.add('visible-success');
            if (kind === 'error') box.classList.add('visible-error');
        }

        function addAction(action: 'sending' | 'error' | 'sent' | null) {
            clearFormStates();

            switch (action) {
                case 'sending':
                    formBox?.classList.add('sending');
                    setMessageVisibility('none');
                    break;

                case 'error':
                    formBox?.classList.add('error');
                    setMessageVisibility('error');
                    break;

                case 'sent':
                    formBox?.classList.add('sent');
                    setMessageVisibility('success');
                    break;

                default:
                    setMessageVisibility('none');
                    break;
            }
        }

        function setMessage(action: 'clean' | 'error' | 'success', text: string = '') {
            const { msg, err } = getMessageElements();

            if (!msg || !err) {
                console.warn('messageAction: missing elements', { msg, err });
                return;
            }

            if (action === 'clean') {
                setMessageVisibility('none');
                msg.textContent = '';
                err.textContent = '';
            }

            if (action === 'error') {
                setMessageVisibility('error');
                msg.textContent = '';
                err.textContent = text;
            }

            if (action === 'success') {
                setMessageVisibility('success');
                err.textContent = '';
                msg.textContent = text;
            }
        }
        validator
            .addField('#name', [
                {
                    rule: Rules.Required,
                    errorMessage: 'El nombre es obligatorio.',
                },
                {
                    rule: Rules.MaxLength,
                    value: 15,
                    errorMessage: 'El nombre no debe superar los 75 caracteres.',
                },
            ])
            .addField('#subject', [
                {
                    rule: Rules.Required,
                    errorMessage: 'El asunto es obligatorio.',
                },
                {
                    rule: Rules.MaxLength,
                    value: 180,
                    errorMessage: 'El asunto no debe superar los 180 caracteres.',
                },
            ])
            .addField('#email', [
                {
                    rule: Rules.Required,
                    errorMessage: 'El correo electrónico es obligatorio.',
                },
                {
                    rule: Rules.Email,
                    errorMessage: 'El correo electrónico debe ser una dirección válida.',
                },
                {
                    rule: Rules.MinLength,
                    errorMessage: 'El correo debe tener al menos 5 caracteres.',
                    value: 5,
                },
                {
                    rule: Rules.MaxLength,
                    errorMessage: 'El correo electrónico no debe superar los 75 caracteres.',
                    value: 75,
                },
            ])
            .addField('#phone', [
                {
                    rule: Rules.Required,
                    errorMessage: 'El teléfono es obligatorio.',
                },
                {
                    rule: Rules.Number,
                },
                {
                    rule: Rules.MinLength,
                    value: 8,
                    errorMessage: 'El teléfono debe tener al menos 8 caracteres.',
                },
                {
                    rule: Rules.MaxLength,
                    errorMessage: 'El teléfono no debe superar los 9 caracteres.',
                    value: 9,
                },
            ])
            .addField('#message', [
                {
                    rule: Rules.Required,
                    errorMessage: 'El mensaje es obligatorio.',
                },
                {
                    rule: Rules.MaxLength,
                    value: 500,
                    errorMessage: 'El mensaje no debe superar los 500 caracteres.',
                },
            ])
            .onSuccess((event) => {
                const form = event?.target instanceof HTMLFormElement ? event.target : null;
                if (!form) return console.warn('No se encontró el formulario en onSuccess');
                const data = new FormData(form);

                addAction('sending');

                load(API_PUBLIC_KEY).then((recaptcha) => {
                    recaptcha.execute('validate_captcha').then((token) => {
                        data.append('token', token);

                        formService
                            .contact(data)
                            .then(({ data }) => {
                                if (data.state) {
                                    addAction('sent');
                                    setMessage('success', data.message);
                                    setTimeout(() => {
                                        form.reset();
                                        setMessage('clean');
                                        clearFormStates();
                                    }, 8000);
                                } else {
                                    addAction('error');
                                    setMessage('error', data.message);
                                }
                            })
                            .catch((error) => {
                                addAction('error');
                                setMessage('error', error.response.data.message);
                            });
                    });
                });
            })
            .setCurrentLocale('es');
    }
}

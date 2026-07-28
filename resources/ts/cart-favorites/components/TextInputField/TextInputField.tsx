import { HelperText, Label, Textarea, TextareaProps, TextInput, TextInputProps } from 'flowbite-react';
import { useController } from 'react-hook-form';

type HookFormTextFieldProps = Omit<TextInputProps, 'name'> & {
    name: string;
    label?: string;
    className?: string;
};

type HookFormTextareaProps = Omit<TextareaProps, 'name'> & {
    name: string;
    label?: string;
    className?: string;
};

export function TextInputField({ name, onChange, onBlur, label, className, ...otherProps }: HookFormTextFieldProps) {
    const { field, fieldState } = useController({ name });

    const handleOnChange = (event: any) => {
        field.onChange(event);
        onChange && onChange(event);
    };

    const handleOnBlur = (event: any) => {
        field.onBlur();
        onBlur && onBlur(event);
    };

    const error = fieldState.error;

    return (
        <div className={className}>
            {label && (
                <div className="mb-0.5 block">
                    <Label htmlFor={name} color={error && 'failure'}>
                        {label}
                    </Label>
                </div>
            )}
            <TextInput
                {...otherProps}
                id={name}
                name={name}
                color={error && 'failure'}
                onChange={handleOnChange}
                onBlur={handleOnBlur}
                value={field.value}
                ref={field.ref}
            />
            <HelperText className="text-danger! mt-1">{error?.message}</HelperText>
        </div>
    );
}

export function TextareaField({ name, onChange, onBlur, label, className, ...otherProps }: HookFormTextareaProps) {
    const { field, fieldState } = useController({ name });

    const handleOnChange = (event: any) => {
        field.onChange(event);
        onChange && onChange(event);
    };

    const handleOnBlur = (event: any) => {
        field.onBlur();
        onBlur && onBlur(event);
    };

    const error = fieldState.error;

    return (
        <div className={`${className ? className : ''} mb-2`}>
            {label && (
                <div className="mb-0.5 block">
                    <Label htmlFor={name} color={error && 'failure'}>
                        {label}
                    </Label>
                </div>
            )}
            <Textarea
                {...otherProps}
                id={name}
                name={name}
                color={error && 'failure'}
                onChange={handleOnChange}
                onBlur={handleOnBlur}
                value={field.value}
                ref={field.ref}
            />
            <HelperText className="text-danger! mt-1">{error?.message}</HelperText>
        </div>
    );
}

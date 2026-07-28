import { useCallback, useInsertionEffect, useRef } from "react";

type AnyFunction = (...args: any[]) => any;

function useEvent<T extends AnyFunction>(callback?: T) {
  const ref = useRef<AnyFunction | undefined>(() => {
    throw new Error("Cannot call an event handler while rendering.");
  });
  useInsertionEffect(() => {
    ref.current = callback;
  });
  return useCallback<AnyFunction>((...args) => ref.current?.(...args), []) as T;
}
export default useEvent;

export enum ApiEventListeners {
  alert = "alert.notification",
}

type extraProps = { id: number };

export function existingInArray<T>(dataArray: (extraProps & T)[], product: extraProps & T) {
  return dataArray.find(item => product.id === item.id);
}

export type dispatchEventType = Event & {
  detail: any;
};

export function dispatch(action: ApiEventListeners, data: any) {
  const event = new CustomEvent<dispatchEventType>(action, {
    detail: data,
  });
  window.dispatchEvent(event);
}

export function listener(action: ApiEventListeners, callback: (e: Event) => void) {
  window.addEventListener(action, callback);
}

export function number_format(
  number: number | string,
  decimals: number = 0,
  dec_point: string = ".",
  thousands_sep: string = ","
): string {
  const n: number = !isFinite(+number) ? 0 : +number;
  const price: number = !isFinite(+decimals) ? 0 : Math.abs(decimals);
  const sep: string = typeof thousands_sep === "undefined" ? "," : thousands_sep;
  const dec: string = typeof dec_point === "undefined" ? "." : dec_point;
  let s: string | string[] = "";
  const toFixedFix = (n: number, price: number): string => {
    const k: number = Math.pow(10, price);
    return "" + Math.round(n * k) / k;
  };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (price ? toFixedFix(n, price) : "" + Math.round(n)).split(".");
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || "").length < price) {
    s[1] = s[1] || "";
    s[1] += new Array(price - s[1].length + 1).join("0");
  }
  return s.join(dec);
}

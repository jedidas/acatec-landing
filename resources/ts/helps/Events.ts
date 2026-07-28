import EventEmitter from "eventemitter3";

const eventEmitter = new EventEmitter();

export const emitEvent = (eventName: string, payload?: any) => {
  eventEmitter.emit(eventName, payload);
};

export const addEventListener = <T>(eventName: string, listener: (data?: T) => void) => {
  eventEmitter.on(eventName, listener);
};

export const removeEventListener = <T>(eventName: string, listener: (payload?: T) => void) => {
  return eventEmitter.off(eventName, listener);
};

const Events = {
  emitEvent,
  addEventListener,
  removeEventListener,
};
export default Events;

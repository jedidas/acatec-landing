import i18n from "i18next";
import { initReactI18next } from "react-i18next";

import es from "@resources/lang/es.json";

i18n.use(initReactI18next).init({
  fallbackLng: "es",
  debug: false,
  interpolation: {
    escapeValue: false,
  },
  resources: {
    es: {
      translation: es,
    },
  },
});

export default i18n;

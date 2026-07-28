import { defineConfig } from "eslint/config";
import { configs } from "@eslint/js";
import { browser, node } from "globals";
import tsPlugin, {
    configs as _configs,
} from "@typescript-eslint/eslint-plugin";
import tsParser from "@typescript-eslint/parser";
import xo from "eslint-config-xo";
import eslintPluginPrettier from "eslint-plugin-prettier";
import eslintConfigPrettier from "eslint-config-prettier";

export default defineConfig([
    xo,
    {
        files: ["**/*.{js,mjs,cjs,ts,mts,cts,jsx,tsx}"],
        ignores: ["node_modules/**", "dist/**", "build/**"],
        languageOptions: {
            parser: tsParser,

            globals: { ...browser, ...node },
            ecmaVersion: 2024,
            sourceType: "module",
        },
        plugins: {
            "@typescript-eslint": tsPlugin,
            prettier: eslintPluginPrettier,
        },
        extends: [configs.recommended, _configs.recommended],
        rules: {
            "no-unused-vars": "off",
            "@typescript-eslint/no-unused-vars": [
                "warn",
                { argsIgnorePattern: "^_", varsIgnorePattern: "^_" },
            ],
            "no-console": "warn",
            "import/no-default-export": "off",
            "prefer-const": "warn",
            "no-undef": "off",
            "@typescript-eslint/explicit-function-return-type": [
                "warn",
                { allowExpressions: true },
            ],
        },
    },
    eslintConfigPrettier,
]);

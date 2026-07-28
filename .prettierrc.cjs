module.exports = {
  // foo => bar instead of (foo) => bar
  arrowParens: "avoid",
  printWidth: 120,
  // https://prettier.io/docs/en/options.html#trailing-commas claims that this is a default, but it doesn't actually appear to be
  trailingComma: "es5",
  // Sort imports with https://github.com/IanVS/prettier-plugin-sort-imports
  semi: true,
  tabWidth: 2,
  plugins: ["@ianvs/prettier-plugin-sort-imports", "@prettier/plugin-php"],
  importOrder: [
    "^@vitejs/(.*)$",
    "",
    ".module.scss$",
    "",
    "^[./]",
    "^@helps/(.*)$",
    "^@resources/(.*)$",
    "^@modules/(.*)$",
    "^@services/(.*)$",
  ],
  singleQuote: false,
  importOrderParserPlugins: ["typescript", "jsx"],
  importOrderTypeScriptVersion: "5.0.0",
};

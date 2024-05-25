const js = require("@eslint/js");
const globals = require("globals");

module.exports = [
  js.configs.recommended,
  {
    "languageOptions": {
      "ecmaVersion": "latest",
      "globals": {
        ...globals.browser,
        ...globals.node,
      },
      "parserOptions": {
        "ecmaVersion": "latest",
        "ecmaFeatures": {
          "impliedStrict": true,
        },
      },
    },
    "rules": {
      "array-bracket-spacing": "error",
      "camelcase": "error",
      "capitalized-comments": [
        "error",
        "always",
        {
          "ignoreInlineComments": true,
          "ignoreConsecutiveComments": true,
        },
      ],
      "comma-dangle": [
        "error",
        {
          "arrays": "always-multiline",
          "objects": "always-multiline",
          "imports": "always-multiline",
          "exports": "always-multiline",
          "functions": "ignore",
        },
      ],
      "indent": ["warn", 2],
      "max-len": [
        "error",
        {
          "code": 80,
          "tabWidth": 2,
          "ignoreUrls": true,
        },
      ],
      // "no-console": [
      //   "error",
      //   {
      //     "allow": ["info", "warn", "error"],
      //   },
      // ],
      "no-constructor-return": "error",
      "no-else-return": "error",
      "no-multi-spaces": [
        "error",
        {
          "ignoreEOLComments": true,
        },
      ],
      "no-multiple-empty-lines": "error",
      "no-tabs": "error",
      "no-trailing-spaces": "error",
      "no-var": "error",
      "prefer-arrow-callback": "error",
      "prefer-const": "error",
      "prefer-template": "error",
      "quotes": [
        "error",
        "double",
        {
          "avoidEscape": true,
          "allowTemplateLiterals": true,
        },
      ],
      "semi": ["error", "always"],
      "space-in-parens": "error",
      "spaced-comment": "error",
    },
  },
];

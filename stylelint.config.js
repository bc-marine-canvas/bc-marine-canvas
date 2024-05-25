module.exports = {
  "extends": "stylelint-config-standard-scss",
  "plugins": [
    "stylelint-scss",
  ],
  "rules": {
    "at-rule-no-unknown": [
      true,
      {
        "ignoreAtRules": [
          "at-root",
          "content",
          "debug",
          "each",
          "else",
          "error",
          "extend",
          "for",
          "forward",
          "function",
          "if",
          "include",
          "mixin",
          "return",
          "use",
          "warn",
          "while",
        ],
      },
    ],
    "no-empty-source": null,
    "scss/at-extend-no-missing-placeholder": null,
  },
};

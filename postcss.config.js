const Autoprefixer = require("autoprefixer");
const PurgeCSS = require("@fullhuman/postcss-purgecss");

const plugins = [
  new Autoprefixer(),
  new PurgeCSS({
    content: ["./hugo_stats.json"],
    defaultExtractor: (content) => {
      const elements = JSON.parse(content).htmlElements;

      return [
        ...(elements.tags || []),
        ...(elements.classes || []),
        ...(elements.ids || []),
      ];
    },
    safelist: [
      "active",
      "show",
      "collapse",
      "collapsing",
      "collapsed",
      "collapse-horizontal",
      "was-validated",
      "fade",
    ],
  }),
];

module.exports = {
  plugins: plugins,
};

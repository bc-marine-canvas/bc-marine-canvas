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
      "collapse",
      "collapse-horizontal",
      "collapsed",
      "collapsing",
      "fade",
      "show",
      "was-validated",
    ],
  }),
];

module.exports = {
  plugins: plugins,
};

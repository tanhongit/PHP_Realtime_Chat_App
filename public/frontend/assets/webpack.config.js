const path = require("path");
const StylelintPlugin = require("stylelint-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

var config = {
    entry: {
        main: ["./css/style.css", "./js/main.js"],
        editor: {
            import: [
                '../css/styles.css',

                '../js/script.js',
                '../js/user.js',
                '../js/chat.js',
            ]
        }
    },
    output: {
        filename: "[name].js",
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: "",
                        },
                    },
                    {
                        loader: "css-loader",
                    },
                    {
                        loader: "postcss-loader",
                    },
                ],
            },
            {
                test: /\.svg/,
                type: "asset",
                parser: {
                    dataUrlCondition: {
                        maxSize: 8192
                    }
                },
                use: 'svgo-loader'
            },
            {
                test: /\.png|jpg|gif/,
                type: "asset/resource",
            },
            {
                enforce: "pre",
                test: /\.js$/,
                exclude: [/node_modules/, /vendor/],
                loader: "eslint-loader",
                options: {
                    fix: true,
                },
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "babel-loader",
            },
        ],
    },
    externals: {
        jquery: 'jQuery',
    },
    optimization: {
        minimize: true,
        minimizer: [`...`, new CssMinimizerPlugin()],
    },

    plugins: [
        new StylelintPlugin({
            files: ["./**/*.{scss,sass}"],
            fix: true,
        }),
        new MiniCssExtractPlugin(),
    ],
};
module.exports = (env, argv) => {
    argv.mode === "development"
        ? (config.devtool = "eval-cheap-module-source-map")
        : (config.devtool = "source-map");

    return config;
};

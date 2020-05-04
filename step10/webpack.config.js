const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
module.exports = {
    entry: './src/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist')
    },
    devtool: 'source-map',
    plugins: [
        new CopyWebpackPlugin([
            {
                from: 'src/img/*',
                to: 'img',
                flatten: true
            }
        ]),
        new HtmlWebpackPlugin({
            title: 'Step 10',
            filename: 'index.html',
            template: 'src/html/index.html',
            inject: 'head'
        }),
        new CopyWebpackPlugin([
            {
                from: 'src/audio/*',
                to: 'audio',
                flatten: true
            }
        ])
    ],
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    'style-loader',
                    'css-loader',
                    'resolve-url-loader',
                    'sass-loader?sourceMap'
                ]
            }
        ]
    }
};
const Encore = require('@symfony/webpack-encore');

const CopyPlugin = require('copy-webpack-plugin');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addStyleEntry('css/home', './assets/styles/style-home.scss')
    .addStyleEntry('css/accompaniment-and-formation', './assets/styles/style-accompaniment-and-formation.scss')
    .addStyleEntry('css/raw-and-living-food', './assets/styles/style-raw-and-living-food.scss')
    .addStyleEntry('css/blog-content', './assets/styles/style-blog-content.scss')
    .addStyleEntry('css/error-page', './assets/styles/style-error-page.scss')
    .addStyleEntry('css/admin', './assets/styles/style-admin.scss')
    .addStyleEntry('css/login', './assets/styles/style-login.scss')
    .addStyleEntry('css/account', './assets/styles/style-account.scss')

    .addEntry('app', './assets/app.js')
    .addEntry('app_home', './assets/app-home.js')
    .addEntry('app-admin', './assets/app-admin.js')
    .addEntry('app_admin_publish', './assets/admin_publish.js')
    .addEntry('app_admin_send_newsletter', './assets/admin-send-newsletter.js')

    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    // enables Sass/SCSS support
    .enableSassLoader()


    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()

    .addPlugin(
        new CopyPlugin({
            patterns: [
                { from: './assets/img', to: 'img' },
                { from: './assets/bundles', to: 'bundles' }
            ]
        }),
    )
;

Encore.configureWatchOptions(watchOptions => {
        watchOptions.poll = 250; // check for changes every 250 milliseconds
    });

module.exports = Encore.getWebpackConfig();

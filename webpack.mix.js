const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

mix.js("resources/js/backend/script.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/user.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/sejarah.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/visimisi.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/kategori.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/tag.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/berita.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/pengumuman.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/prestasi.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/aplikasi.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/album.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/jurusan.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/sarpras.js", "public/js/backend").sourceMaps();
mix.js("resources/js/backend/pendidik.js", "public/js/backend").sourceMaps();

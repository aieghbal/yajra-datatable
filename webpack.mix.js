mix.js('resources/assets/js/app.js', 'public/js');
if (mix.inProduction() || true) {
    mix.version()
}

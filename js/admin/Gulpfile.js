var gulp = require('flarum-gulp');

gulp({
    modules: {
        'pixelfederation/redis-session': 'src/**/*.js'
    }
});

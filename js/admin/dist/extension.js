'use strict';

System.register('pixelfederation/redis-session/components/RedisSessionSettingsModal', ['flarum/components/SettingsModal'], function (_export, _context) {
    "use strict";

    var SettingsModal, RedisSessionSettingsModal;
    return {
        setters: [function (_flarumComponentsSettingsModal) {
            SettingsModal = _flarumComponentsSettingsModal.default;
        }],
        execute: function () {
            RedisSessionSettingsModal = function (_SettingsModal) {
                babelHelpers.inherits(RedisSessionSettingsModal, _SettingsModal);

                function RedisSessionSettingsModal() {
                    babelHelpers.classCallCheck(this, RedisSessionSettingsModal);
                    return babelHelpers.possibleConstructorReturn(this, (RedisSessionSettingsModal.__proto__ || Object.getPrototypeOf(RedisSessionSettingsModal)).apply(this, arguments));
                }

                babelHelpers.createClass(RedisSessionSettingsModal, [{
                    key: 'className',
                    value: function className() {
                        return 'RedisSessionSettingsModal Modal--small';
                    }
                }, {
                    key: 'title',
                    value: function title() {
                        return app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.title');
                    }
                }, {
                    key: 'form',
                    value: function form() {
                        return [m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.host_label')
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('pixelfederation-redis-session.host') })
                        ), m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.port_label')
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('pixelfederation-redis-session.port') })
                        ), m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.db_label')
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('pixelfederation-redis-session.db') })
                        ), m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.password_label')
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('pixelfederation-redis-session.password') })
                        ), m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.ttl_label')
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('pixelfederation-redis-session.ttl') })
                        )];
                    }
                }]);
                return RedisSessionSettingsModal;
            }(SettingsModal);

            _export('default', RedisSessionSettingsModal);
        }
    };
});;
'use strict';

System.register('pixelfederation/redis-session/main', ['flarum/app', 'pixelfederation/redis-session/components/RedisSessionSettingsModal'], function (_export, _context) {
    "use strict";

    var app, RedisSessionSettingsModal;
    return {
        setters: [function (_flarumApp) {
            app = _flarumApp.default;
        }, function (_pixelfederationRedisSessionComponentsRedisSessionSettingsModal) {
            RedisSessionSettingsModal = _pixelfederationRedisSessionComponentsRedisSessionSettingsModal.default;
        }],
        execute: function () {

            app.initializers.add('pixelfederation-ext-redis-session', function () {
                app.extensionSettings['pixelfederation-redis-session'] = function () {
                    return app.modal.show(new RedisSessionSettingsModal());
                };
            });
        }
    };
});
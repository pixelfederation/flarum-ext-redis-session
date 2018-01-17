import SettingsModal from 'flarum/components/SettingsModal';

export default class RedisSessionSettingsModal extends SettingsModal {
    className() {
        return 'RedisSessionSettingsModal Modal--small';
    }

    title() {
        return app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <label>{app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.host_label')}</label>
                <input className="FormControl" bidi={this.setting('pixelfederation-redis-session.host')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.port_label')}</label>
                <input className="FormControl" bidi={this.setting('pixelfederation-redis-session.port')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.db_label')}</label>
                <input className="FormControl" bidi={this.setting('pixelfederation-redis-session.db')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.password_label')}</label>
                <input className="FormControl" bidi={this.setting('pixelfederation-redis-session.password')}/>
            </div>,

            <div className="Form-group">
                <label>{app.translator.trans('pixelfederation-redis-session.admin.redis_session_settings.ttl_label')}</label>
                <input className="FormControl" bidi={this.setting('pixelfederation-redis-session.ttl')}/>
            </div>,
        ];
    }
}
